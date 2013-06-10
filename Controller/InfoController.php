<?php

namespace Galaxy\DocumentsBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class InfoController extends FOSRestController
{

    public function getDocumentsFundsAction($userId)
    {
        $accounts = array(
            "active" => 1,
            "safe" => 2,
            "deposite" => 3,
        );
        
        $repo = $this->getRestRepository();
        $response = array();
        foreach ($accounts as $account => $id) {
            $response[$account] = $repo->getUserRest($id, $userId);
        }
        
        $view = $this->view($response);
        return $this->handleView($view);
    }

    /**
     * 
     * @return \Galaxy\DocumentsBundle\Repository\RestRepository
     */
    private function getRestRepository()
    {
        $namespace = "GalaxyDocumentsBundle:Rest";
        $em = $this->getDoctrine()->getEntityManager();
        
        $repo = $em->getRepository($namespace);
        return $repo;
    }

}