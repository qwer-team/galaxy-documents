<?php

namespace Galaxy\DocumentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 */
class Rate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $account1;

    /**
     * @var integer
     */
    private $account2;

    /**
     * @var float
     */
    private $value;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set account1
     *
     * @param integer $account1
     * @return Rate
     */
    public function setAccount1($account1)
    {
        $this->account1 = $account1;

        return $this;
    }

    /**
     * Get account1
     *
     * @return integer 
     */
    public function getAccount1()
    {
        return $this->account1;
    }

    /**
     * Set account2
     *
     * @param integer $account2
     * @return Rate
     */
    public function setAccount2($account2)
    {
        $this->account2 = $account2;

        return $this;
    }

    /**
     * Get account2
     *
     * @return integer 
     */
    public function getAccount2()
    {
        return $this->account2;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Rate
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }
}
