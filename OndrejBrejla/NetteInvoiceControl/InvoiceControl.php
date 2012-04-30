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

    /** @var Data */
    private $data;

    /**
     * Initializes new Invoice.
     *
     * @param string $id
     * @param string $title
     */
    public function __construct(Data $data) {
        $this->data = $data;
    }

    /**
     * Counts final untaxed value of all items.
     *
     * @return int
     */
    public function countFinalUntaxedValue() {
        foreach ($this->data->items as $item) {
            $sum += $item->getUntaxedUnitValue() * $item->getUnits();
        }

        return $sum;
    }

    /**
     * Counts final tax value of all items.
     *
     * @return int
     */
    public function countFinalTaxValue() {
        foreach ($this->data->items as $item) {
            $sum += $item->getTaxValue();
        }

        return $sum;
    }

    /**
     * Counts final value of all items.
     *
     * @return int
     */
    public function countFinalValues() {
        foreach ($this->data->items as $item) {
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

        $template->title = $this->data->getTitle();
        $template->id = $this->data->getId();

        $template->supplierName = $this->data->getSupplier()->getName();
        $template->supplierStreet = $this->data->getSupplier()->getStreet();
        $template->supplierHouseNumber = $this->data->getSupplier()->getHouseNumber();
        $template->supplierCity = $this->data->getSupplier()->getCity();
        $template->supplierZip = $this->data->getSupplier()->getZip();
        $template->supplierIn = $this->data->getSupplier()->getIn();
        $template->supplierTin = $this->data->getSupplier()->getTin();
        $template->supplierAccountNumber = $this->data->getSupplier()->getAccountNumber();

        $template->dateOfIssuance = $this->data->getDateOfIssuance();
        $template->expirationDate = $this->data->getExpirationDate();
        $template->dateOfVatRevenueRecognition = $this->data->getDateOfVatRevenueRecognition();

        $template->variableSymbol = $this->data->getVariableSymbol();
        $template->specificSymbol = $this->data->getSpecificSymbol();
        $template->constantSymbol = $this->data->getConstantSymbol();

        $template->customerName = $this->data->getCustomer()->getName();
        $template->customerStreet = $this->data->getCustomer()->getStreet();
        $template->customerHouseNumber = $this->data->getCustomer()->getHouseNumber();
        $template->customerCity = $this->data->getCustomer()->getCity();
        $template->customerZip = $this->data->getCustomer()->getZip();
        $template->customerIn = $this->data->getCustomer()->getIn();
        $template->customerTin = $this->data->getCustomer()->getTin();
        $template->customerAccountNumber = $this->data->getCustomer()->getAccountNumber();

        $template->items = $this->data->getItems();

        $template->finalUntaxedValue = $this->countFinalUntaxedValue();
        $template->finalTaxValue = $this->countFinalTaxValue();
        $template->finalValue = $this->countFinalValues();
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