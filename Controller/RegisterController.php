<?php

namespace Galaxy\DocumentsBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Galaxy\DocumentsBundle\Form\RegisterType;

class RegisterController extends FOSRestController
{

    public function getRegisterAction($id){
        $repo = $this->getRegisterRepo();
        $register = $repo->find($id);
        
        $view = $this->view($register);
        return $this->handleView($view);
    }
    
    public function postRegisterUpdateAction($id, Request $request)
    {
        $repo = $this->getRegisterRepo();
        $register = $repo->find($id);
        
        $form = $this->createForm( new RegisterType(), $register);
        //$form->bindRequest($request);
        
        $result = array("result" => "fail");
        $data = $request->request->all();
        $children = $form->all();
        $data = array_intersect_key($data, $children);
        $form->bind($data);
        if($form->isValid()){
            $result = array("result" => "success");
            $this->getDoctrine()->getEntityManager()->flush();
        } else {
            echo $form->getErrorsAsString();
        }
        
        $view = $this->view($result);
        return $this->handleView($view);
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRegisterRepo()
    {
        $namespace = "GalaxyDocumentsBundle:Register";
        $repo = $this->getDoctrine()->getRepository($namespace);
        
        return $repo;
    }

}