<?php

namespace Galaxy\DocumentsBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Galaxy\DocumentsBundle\Entity\Document;
use Galaxy\DocumentsBundle\Form\DocumentType;
use Itc\DocumentsBundle\Event\DocumentEvent;

class DocumentController extends FOSRestController
{

    public function getDocumentAction($id)
    {
        $repo = $this->getDocumentRepo();
        $document = $repo->find($id);

        $view = $this->view($document);
        return $this->handleView($view);
    }

    public function getDocumentsCountAction($type)
    {
        $repo = $this->getDocumentRepo();

        $docTypeRepo = $this->getDocumentTypeRepo();
        $documentType = $docTypeRepo->findOneByTitle($type);

        $qb = $repo->createQueryBuilder('doc');
        $qb->select("count(doc)")
                ->where("doc.documentType = :docType");
        $qb->setParameter("docType", $documentType);

        $count = $qb->getQuery()->getSingleScalarResult();
        $response = array("count" => $count);
        $view = $this->view($response);
        return $this->handleView($view);
    }

    public function getDocumentLengthTypeAction($page, $length, $type)
    {
        $typeRepo = $this->getDocumentTypeRepo();
        $documentType = $typeRepo->findOneByTitle($type);

        $repo = $this->getDocumentRepo();
        $qb = $repo->createQueryBuilder('doc');

        $qb->where("doc.documentType = :docType");
        $qb->orderBy('doc.date', 'DESC');
        $firstResult = $length * ($page - 1);
        $qb->setFirstResult($firstResult)->setMaxResults($length);
        $qb->setParameter("docType", $documentType);

        $result = $qb->getQuery()->getResult();
        $view = $this->view($result);
        return $this->handleView($view);
    }

    public function postDocumentCreateAction($type, Request $request)
    {
        $document = new Document();
        $form = $this->createForm(new DocumentType(), $document);
        $typeRepo = $this->getDocumentTypeRepo();
        $documentType = $typeRepo->findOneByTitle($type);
        $document->setDocumentType($documentType);

        $result = array("result" => "fail");
        $data = $request->request->all();
        $form->bind($data);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($document);
            $em->flush();
            $result = array("result" => "success", "document" => $document);
        } else {
            echo $form->getErrorsAsString();
        }

        $view = $this->view($result);
        return $this->handleView($view);
    }

    public function postDocumentUpdateAction($id, Request $request)
    {
        $repo = $this->getDocumentRepo();
        $document = $repo->find($id);

        $form = $this->createForm(new DocumentType(), $document);
        //$form->bindRequest($request);

        $result = array("result" => "fail");
        $data = $request->request->all();
        $children = $form->all();
        $data = array_intersect_key($data, $children);
        $form->bind($data);
        if ($form->isValid() || $document->getStatus() == 1) {
            $result = array("result" => "success");
            $this->getDoctrine()->getEntityManager()->flush();
        } else {
            echo $form->getErrorsAsString();
        }

        $view = $this->view($result);
        return $this->handleView($view);
    }

    public function getDocumentApproveAction($id)
    {
        $repo = $this->getDocumentRepo();
        $document = $repo->find($id);

        $event = new DocumentEvent($document);
        $result = array("result" => "fail");
        if ($document->getStatus() == 1){
            $document->setStatus(2);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch("approve.document.event", $event);
            $this->getDoctrine()->getEntityManager()->flush();
            $result = array(
                "result" => "success", 
                "document" => $document,
            );
        } 
        
        $view = $this->view($result);
        return $this->handleView($view);
    }
    
    public function getDocumentReturnAction($id)
    {
        $repo = $this->getDocumentRepo();
        $document = $repo->find($id);

        $event = new DocumentEvent($document);
        $result = array("result" => "fail");
        if ($document->getStatus() == 2) {
            $document->setStatus(1);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch("return.document.event", $event);
            $this->getDoctrine()->getEntityManager()->flush();
            $result = array(
                "result" => "success", 
                "document" => $document,
            );
        } 
        
        $view = $this->view($result);
        return $this->handleView($view);
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getDocumentRepo()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $namespace = "GalaxyDocumentsBundle:Document";
        $repo = $em->getRepository($namespace);

        return $repo;
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getDocumentTypeRepo()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $namespace = "GalaxyDocumentsBundle:DocumentType";
        $repo = $em->getRepository($namespace);

        return $repo;
    }

    public function postDocumentCreateApproveAction($type, Request $request)
    {
        $document = new Document();
        $form = $this->createForm(new DocumentType(), $document);
        $typeRepo = $this->getDocumentTypeRepo();
        $documentType = $typeRepo->findOneByTitle($type);
        $document->setDocumentType($documentType);

        $result = array("result" => "fail");
        $em = $this->getDoctrine()->getEntityManager();
        
        try{
            $data = $request->request->all();
            $form->bind($data);
            if ($form->isValid()) {
                $em->getConnection()->beginTransaction();
                
                $em->persist($document);
                $em->flush();
                $result = array("result" => "success", "document" => $document);
            }
            
            $result = $this->getDocumentApproveAction($document->getId());
            $em->getConnection()->commit();
            return $result;
        } catch(\Exception $exception){
            $em->getConnection()->rollback();
            $em->close();
            $view = $this->view($result);
            return $this->handleView($view);
        }
    }
}