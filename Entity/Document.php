<?php

namespace Galaxy\DocumentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itc\DocumentsBundle\Entity\Document\Document as ItcDocument;

/**
 * Document
 */
class Document extends ItcDocument
{

    protected $account;

    public function getAccount()
    {
        return $this->account;
    }

    public function setAccount($account)
    {
        $this->account = $account;
    }
    
    public function getDocumentTypeTitle(){
        return $this->getDocumentType()->getTitle();
    }

}
