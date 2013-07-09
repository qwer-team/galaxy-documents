<?php

namespace Galaxy\DocumentsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Galaxy\DocumentsBundle\Entity\DocumentType;

class DocumentTypes implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        
        $data = array(
            array(
                "title" => "fundsTransfer",
                "description" => "Зачисление средств на счет",
            ),
            array(
                "title" => "servicesDebit",
                "description" => "Списание средств за услуги"
            ),
        );
        
        $code = 1;
        foreach ($data as $value) {
            $docType = new DocumentType();
            $docType->setTitle($value["title"]);
            $docType->setDescription($value["description"]);
            $docType->setCode($code);
            $manager->persist($docType);
            $code++;
        }
        
        $manager->flush();
    }

}