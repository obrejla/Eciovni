<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;
use DateTime;

/**
 * DataBuilder - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class DataBuilder extends Object {

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

    /** @var string */
    private $logo;

    /** @var string */
    private $stamp;

    /** @var Item[] */
    private $items = array();

    /** @var Taxes[] */
    private $taxes = array();

    public function __construct($id, $title, Participant $supplier, Participant $customer, DateTime $expirationDate, DateTime $dateOfIssuance, array $items) {
        $this->id = $id;
        $this->title = $title;
        $this->supplier = $supplier;
        $this->customer = $customer;
        $this->expirationDate = $expirationDate;
        $this->dateOfIssuance = $dateOfIssuance;
        $this->addItems($items);
    }

    /**
     * Adds array of items to the invoice.
     *
     * @param Item[] $items
     * @return void
     */
    private function addItems($items) {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * Adds an item to the invoice.
     *
     * @param Item $item
     * @return void
     */
    private function addItem(Item $item) {
        $this->items[] = $item;
    }

    /**
     * Adds array of taxes to the invoice.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param Taxes[] $taxes
     * @return void
     */
    public function addTaxes($taxes) {
        foreach ($taxes as $tax => $name) {
            $this->addTax($tax, $name);
        }
    }

    /**
     * Adds an tax to the invoice.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param $tax
     * @param $name
     * @return void
     */
    private function addTax($tax, $name) {
        $this->taxes[$tax] = $name;
    }

    /**
     * Sets the variable symbol.
     *
     * @param int $variableSymbol
     * @return DataBuilder
     */
    public function setVariableSymbol($variableSymbol) {
        $this->variableSymbol = $variableSymbol;
        return $this;
    }

    /**
     * Sets the constant symbol.
     *
     * @param int $constantSymbol
     * @return DataBuilder
     */
    public function setConstantSymbol($constantSymbol) {
        $this->constantSymbol = $constantSymbol;
        return $this;
    }

    /**
     * Sets the specific symbol.
     *
     * @param int $specificSymbol
     * @return DataBuilder
     */
    public function setSpecificSymbol($specificSymbol) {
        $this->specificSymbol = $specificSymbol;
        return $this;
    }

    /**
     * Sets the date of VAT revenue recognition.
     *
     * @param DateTime $dateOfTaxablePayment
     * @return DataBuilder
     */
    public function setDateOfVatRevenueRecognition(DateTime $dateOfTaxablePayment) {
        $this->dateOfVatRevenueRecognition = $dateOfTaxablePayment;
        return $this;
    }

    /**
     * Sets the inovice round.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param decimal $inoviceRound
     * @return DataBuilder
     */
    public function setInoviceRound($inoviceRound) {
        $this->inoviceRound = $inoviceRound;
        return $this;
    }

    /**
     * Sets the logo company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $logo
     * @return DataBuilder
     */
    public function setLogo($logo) {
        $this->logo = $logo;
        return $this;
    }

    /**
     * Sets the stamp company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $stamp
     * @return DataBuilder
     */
    public function setStamp($stamp) {
        $this->stamp = $stamp;
        return $this;
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
     * @return string
     */
    public function getExpirationDate() {
        return $this->expirationDate;
    }

    /**
     * Returns the date of issuance in defined format.
     *
     * @return string
     */
    public function getDateOfIssuance() {
        return $this->dateOfIssuance;
    }

    /**
     * Returns the date of VAT revenue recognition in defined format.
     *
     * @return string
     */
    public function getDateOfVatRevenueRecognition() {
        return $this->dateOfVatRevenueRecognition;
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
    public function getStamp() {
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
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return Taxes[]
     */
    public function getTaxes() {
        return $this->taxes;
    }

    /**
     * Returns new Data.
     *
     * @return Data
     */
    public function build() {
        return new DataImpl($this);
    }

}
