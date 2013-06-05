<?php

namespace Galaxy\DocumentsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Galaxy\DocumentsBundle\Entity\Register;

class Registers implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $data = array(
            array(
                "title" => "Активный",
                "pointsTypeName" => "активные очки",
            ),
            array(
                "title" => "Безопасный",
                "pointsTypeName" => "безопасные очки"
            ),
            array(
                "title" => "Депозтный",
                "pointsTypeName" => "депозтные очки"
            ),
        );
        
        foreach ($data as $value) {
            $register = new Register();
            $register->setTitle($value["title"]);
            $register->setPointsTypeName($value["pointsTypeName"]);
            
            $manager->persist($register);
        }
        
        $manager->flush();
    }

}