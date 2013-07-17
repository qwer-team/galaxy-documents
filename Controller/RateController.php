<?php

namespace Galaxy\DocumentsBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RateController extends FOSRestController
{

    public function getRateAction()
    {
        $rate = $this->getRate();

        $view = $this->view($rate);
        return $this->handleView($view);
    }

    /**
     * 
     * @return \Galaxy\DocumentsBundle\Entity\Rate
     */
    private function getRate()
    {
        $em = $this->getDoctrine()->getManager();
        $namespace = "GalaxyDocumentsBundle:Rate";
        $repo = $em->getRepository($namespace);

        $rate = $repo->find(1);
        return $rate;
    }

    public function postRateUpdateAction(Request $request)
    {
        $rate = $this->getRate();
        $value = $request->request->get("value");
        $rate->setValue($value);
        $this->getDoctrine()->getManager()->flush();
        
        $view = $this->view($rate);
        return $this->handleView($view);
    }

}