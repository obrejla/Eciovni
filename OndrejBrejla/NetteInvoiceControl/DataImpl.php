<?php

namespace OndrejBrejla\NetteInvoiceControl;

/**
 * DataImpl - part of Invoice control plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
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

    /** @var Item[] */
    private $items = array();

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
        return $this->dateOfVatRevenueRecognition->format($format);
    }

    /**
     * Returns the array of items.
     *
     * @return Item[]
     */
    public function getItems() {
        return $this->items;
    }

}
