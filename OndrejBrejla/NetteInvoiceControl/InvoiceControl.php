<?php

namespace OndrejBrejla\NetteInvoiceControl;

use \DateTime;

/**
 * InvoiceControl - plugin for Nette Framework for generating invoices using mPDF library.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 */
class InvoiceControl extends Control {

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
     * Initializes new Invoice.
     *
     * @param string $id
     * @param string $title
     */
    public function __construct($id = NULL, $title = NULL) {
        $this->setId($id);
        $this->setTitle($title);
    }

    /**
     * Sets the invoice title.
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title = NULL) {
        if ($title == NULL) {
            $this->title = '';
        } else {
            $this->title = $title;
        }
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
     * Sets the invoice id.
     *
     * @param string $id
     * @return void
     */
    public function setId($id = NULL) {
        if ($id == NULL) {
            $this->id = time();
        } else {
            $this->id = $id;
        }
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
     * Sets the invoice supplier.
     *
     * @param Participant $supplier
     * @return void
     */
    public function setSupplier(Participant $supplier) {
        $this->supplier = $supplier;
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
     * Sets the invoice customer.
     *
     * @param Participant $customer
     * @return void
     */
    public function setCustomer(Participant $customer) {
        $this->customer = $customer;
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
     * Sets the variable symbol.
     *
     * @param int $variableSymbol
     * @return void
     */
    public function setVariableSymbol($variableSymbol) {
        $this->variableSymbol = $variableSymbol;
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
     * Sets the constant symbol.
     *
     * @param int $constantSymbol
     * @return void
     */
    public function setConstantSymbol($constantSymbol) {
        $this->constantSymbol = $constantSymbol;
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
     * Sets the specific symbol.
     *
     * @param int $specificSymbol
     */
    public function setSpecificSymbol($specificSymbol) {
        $this->specificSymbol = $specificSymbol;
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
     * Sets the expiration date.
     *
     * @param DateTime $expirationDate
     * @return void
     */
    public function setExpirationDate(DateTime $expirationDate) {
        $this->expirationDate = $expirationDate;
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
     * Sets the date of issuance.
     *
     * @param DateTime $dateOfIssuance
     * @return void
     */
    public function setDateOfIssuance(DateTime $dateOfIssuance) {
        $this->dateOfIssuance = $dateOfIssuance;
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
     * Sets the date of VAT revenue recognition.
     *
     * @param DateTime $dateOfTaxablePayment
     * @return void
     */
    public function setDateOfVatRevenueRecognition(DateTime $dateOfTaxablePayment) {
        $this->dateOfVatRevenueRecognition = $dateOfTaxablePayment;
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
     * Adds an item to the invoice.
     *
     * @param Item $item
     * @return void
     */
    public function addItem(Item $item) {
        $this->items[] = $item;
    }

    /**
     * Adds array of items to the invoice.
     *
     * @param Item[] $items
     * @return void
     */
    public function addItems($items) {
        foreach ($items as $item) {
            $this->addItem($item);
        }
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
     * Counts final untaxed value of all items.
     *
     * @return int
     */
    public function getFinalUntaxedValue() {
        foreach ($this->items as $item) {
            $sum += $item->getUntaxedUnitValue() * $item->getUnits();
        }

        return $sum;
    }

    /**
     * Counts final tax value of all items.
     *
     * @return int
     */
    public function getFinalTaxValue() {
        foreach ($this->items as $item) {
            $sum += $item->getTaxValue();
        }

        return $sum;
    }

    /**
     * Counts final value of all items.
     *
     * @return int
     */
    public function getFinalValues() {
        foreach ($this->items as $item) {
            $sum += $item->getFinalValue();
        }

        return $sum;
    }

    /**
     * Exports Invoice template via passed mPDF.
     *
     * @param mPDF $mpdf
     * @param string $name
     * @param string $dest
     * @return void
     */
    public function exportToPdf(mPDF $mpdf, $name = NULL, $dest = NULL) {
        $this->generate();
        $mpdf->WriteHTML((string) $this->template);

        if (($name !== '') && ($dest !== NULL)) {
            $mpdf->Output($name, $dest);
        } elseif ($dest !== NULL) {
            $mpdf->Output('', $dest);
        } else {
            $mpdf->Output($name, $dest);
        }
    }

    /**
     * Generates the invoice to the defined template.
     *
     * @return void
     */
    public function generate() {
        $template = $this->template;

        $template->setFile(dirname(__FILE__) . '/InvoiceControl.latte');
        $template->registerHelper('round', 'InvoiceControl::round');

        $template->title = $this->getTitle();
        $template->id = $this->getId();

        $template->supplierName = $this->supplier->getName();
        $template->supplierStreet = $this->supplier->getStreet();
        $template->supplierHouseNumber = $this->supplier->getHouseNumber();
        $template->supplierCity = $this->supplier->getCity();
        $template->supplierZip = $this->supplier->getZip();
        $template->supplierIn = $this->supplier->getIn();
        $template->supplierTin = $this->supplier->getTin();
        $template->supplierAccountNumber = $this->supplier->getAccountNumber();

        $template->dateOfIssuance = $this->getDateOfIssuance();
        $template->expirationDate = $this->getExpirationDate();
        $template->dateOfVatRevenueRecognition = $this->getDateOfVatRevenueRecognition();

        $template->variableSymbol = $this->getVariableSymbol();
        $template->specificSymbol = $this->getSpecificSymbol();
        $template->constantSymbol = $this->getConstantSymbol();

        $template->customerName = $this->customer->getName();
        $template->customerStreet = $this->customer->getStreet();
        $template->customerHouseNumber = $this->customer->getHouseNumber();
        $template->customerCity = $this->customer->getCity();
        $template->customerZip = $this->customer->getZip();
        $template->customerIn = $this->customer->getIn();
        $template->customerTin = $this->customer->getTin();
        $template->customerAccountNumber = $this->customer->getAccountNumber();

        $template->items = $this->getItems();

        $template->finalUntaxedValue = $this->getFinalUntaxedValue();
        $template->finalTaxValue = $this->getFinalTaxValue();
        $template->finalValue = $this->getFinalValues();
    }

    /**
     * Renderers the invoice to the defined template.
     *
     * @return void
     */
    public function render() {
        $this->generate();

        $this->template->render();
    }

    /**
     * Rounds value to defined precision.
     *
     * @param double $value
     * @param int $precision
     * @return string
     */
    public static function round($value, $precision = 2) {
        return number_format(round($value, $precision), 2, ',', '');
    }

}