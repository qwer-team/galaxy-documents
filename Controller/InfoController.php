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
            "transActive" => 4,
            "transSafe" => 5,
        );

        $repo = $this->getRestRepository();
        $response = array();
        foreach ($accounts as $account => $id) {
            $response[$account] = $repo->getUserRest($id, $userId);
        }

        $rates = $this->getRates();
        $response['rates'] = $rates; 
        $view = $this->view($response);
        return $this->handleView($view);
    }

    private function getRates()
    {
        $repo = $this->getRateRepository();
        $rates = $repo->findAll();
        
        $result = array();
        foreach($rates as $rate){
            $result[$rate->getAccount2()->getTag()] = $rate->getValue();
        }
        
        return $result;
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
    
    /**
     * 
     * @return \Galaxy\DocumentsBundle\Repository\RestRepository
     */
    private function getRateRepository()
    {
        $namespace = "GalaxyDocumentsBundle:Rate";
        $em = $this->getDoctrine()->getEntityManager();

        $repo = $em->getRepository($namespace);
        return $repo;
    }

}