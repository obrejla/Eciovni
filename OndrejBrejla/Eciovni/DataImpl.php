<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;
use DateTime;

/**
 * DataImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class DataImpl extends Object implements Data {

    /** @var string */
    private $title;

    /** @var string */
    private $id;

    /** @var Participant */
    private $supplier;

    /** @var Participant */
    private $customer;

    /** @var int */
    private $variableSymbol = 0;

    /** @var int */
    private $constantSymbol = 0;

    /** @var int */
    private $specificSymbol = 0;

    /** @var DateTime */
    private $expirationDate;

    /** @var DateTime */
    private $dateOfIssuance;

    /** @var DateTime */
    private $dateOfVatRevenueRecognition;
    
    /** @var Decimal */
    private $inoviceRound;
    
    /** @var String */
    private $logo;
    
    /** @var String */
    private $stamp;

    /** @var Item[] */
    private $items = array();
    
    /** @var Taxes[] */
    private $taxes = array();

    public function __construct(DataBuilder $dataBuilder) {
        $this->title = $dataBuilder->getTitle();
        $this->id = $dataBuilder->getId();
        $this->supplier = $dataBuilder->getSupplier();
        $this->customer = $dataBuilder->getCustomer();
        $this->variableSymbol = $dataBuilder->getVariableSymbol();
        $this->constantSymbol = $dataBuilder->getConstantSymbol();
        $this->specificSymbol = $dataBuilder->getSpecificSymbol();
        $this->expirationDate = $dataBuilder->getExpirationDate();
        $this->dateOfIssuance = $dataBuilder->getDateOfIssuance();
        $this->dateOfVatRevenueRecognition = $dataBuilder->getDateOfVatRevenueRecognition();
        $this->inoviceRound = $dataBuilder->getInoviceRound();
        $this->logo = $dataBuilder->getLogo();
        $this->stamp = $dataBuilder->getStamp();
        $this->items = $dataBuilder->getItems();
        $this->taxes = $dataBuilder->getTaxes();
    }

    /**
     * Returns the invoice title.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Returns the invoice id.
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the invoice supplier.
     *
     * @return Participant
     */
    public function getSupplier() {
        return $this->supplier;
    }

    /**
     * Returns the invoice customer.
     *
     * @return Participant
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * Returns the variable symbol.
     *
     * @return int
     */
    public function getVariableSymbol() {
        return $this->variableSymbol;
    }

    /**
     * Returns the constant symbol.
     *
     * @return int
     */
    public function getConstantSymbol() {
        return $this->constantSymbol;
    }

    /**
     * Returns the specific symbol.
     *
     * @return int
     */
    public function getSpecificSymbol() {
        return $this->specificSymbol;
    }

    /**
     * Returns the expiration date in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getExpirationDate($format = 'd.m.Y') {
        return $this->expirationDate->format($format);
    }

    /**
     * Returns the date of issuance in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getDateOfIssuance($format = 'd.m.Y') {
        return $this->dateOfIssuance->format($format);
    }

    /**
     * Returns the date of VAT revenue recognition in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getDateOfVatRevenueRecognition($format = 'd.m.Y') {
        return $this->dateOfVatRevenueRecognition === NULL ? '' : $this->dateOfVatRevenueRecognition->format($format);
    }
 
    /**
     * Returns the inovice round.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return decimal
     */
    public function getInoviceRound() {
        return $this->inoviceRound;
    }
    
     /**
     * Returns the logo company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getLogo() {
        return $this->logo;
    }
    
    /**
     * Returns the stamp company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getStamp()
    {
        return $this->stamp;
    }
    
    /**
     * Returns the array of items.
     *
     * @return Item[]
     */
    public function getItems() {
        return $this->items;
    }
    
    /**
     * Returns the array of taxes.
     *
     * @return Taxes[]
     */
    public function getTaxes() {
        return $this->taxes;
    }

}
