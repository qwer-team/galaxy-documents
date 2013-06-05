<?php

namespace Galaxy\DocumentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itc\DocumentsBundle\Entity\Document\Register as ItcRegister;

/**
 * Register
 */
class Register extends ItcRegister
{
    protected $pointsTypeName;
    protected $start;
    protected $accountHint;
    protected $period;
    protected $periodCost;
    protected $acquisitionExtensionServices;
    protected $pointsTypeHint;
    protected $textPaymentService;
    protected $points;
    protected $cost;
    protected $notificationZeroBalance;
    
    public function getPointsTypeName()
    {
        return $this->pointsTypeName;
    }

    public function setPointsTypeName($pointsTypeName)
    {
        $this->pointsTypeName = $pointsTypeName;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getAccountHint()
    {
        return $this->accountHint;
    }

    public function setAccountHint($accountHint)
    {
        $this->accountHint = $accountHint;
    }
    
    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function getPeriodCost()
    {
        return $this->periodCost;
    }

    public function setPeriodCost($periodCost)
    {
        $this->periodCost = $periodCost;
    }

    public function getAcquisitionExtensionServices()
    {
        return $this->acquisitionExtensionServices;
    }

    public function setAcquisitionExtensionServices($acquisitionExtensionServices)
    {
        $this->acquisitionExtensionServices = $acquisitionExtensionServices;
    }
    
    public function getPointsTypeHint()
    {
        return $this->pointsTypeHint;
    }

    public function setPointsTypeHint($pointsTypeHint)
    {
        $this->pointsTypeHint = $pointsTypeHint;
    }

    public function getTextPaymentService()
    {
        return $this->textPaymentService;
    }

    public function setTextPaymentService($textPaymentService)
    {
        $this->textPaymentService = $textPaymentService;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getNotificationZeroBalance()
    {
        return $this->notificationZeroBalance;
    }

    public function setNotificationZeroBalance($notificationZeroBalance)
    {
        $this->notificationZeroBalance = $notificationZeroBalance;
    }




}
