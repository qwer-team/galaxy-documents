<?php

namespace Galaxy\DocumentsBundle\Repository;

use Itc\DocumentsBundle\Entity\Document\RestRepository as ParentRepository;

class RestRepository extends ParentRepository
{

    public function findByAccountAndLevels($accountId, $levels)
    {

        $qb = $this->createQueryBuilder("R");

        $qb->select("R")
                ->where("R.accountId = :accountId")
                ->setParameter("accountId", $accountId);

        for ($level = 1; $level <= 3; $level++) {
            $levelString = "level{$level}";
            $value = $levels[$levelString];
            if (is_null($value)) {
                continue;
            }
            $qb->andWhere("R.{$levelString} = :{$levelString}")
                    ->setParameter($levelString, $value);
        }
        ;

        return $qb->getQuery()->execute();
    }

    public function getUserRest($account, $userId)
    {
        $qb = $this->createQueryBuilder("rest");

        $date = new \DateTime();
        $date->add(\DateInterval::createFromDateString("1 month"));
        $year = $date->format("y");
        $month = $date->format("m");

        $qb->select("rest.sd");

        $qb->where("rest.level1 = :level1");
        $qb->andWhere("rest.accountId = :account");
        $qb->andWhere("rest.year = :year");
        $qb->andWhere("rest.month = :month");

        $params = array(
            "level1" => $userId,
            "account" => $account,
            "year" => $year,
            "month" => $month,
        );

        $qb->setParameters($params);
        
        $result = $qb->getQuery()->getOneOrNullResult();
        
        if (is_null($result)) {
            $amount = 0;
        } else {
            $amount = $result["sd"];
        }

        return (int)$amount;
    }

}