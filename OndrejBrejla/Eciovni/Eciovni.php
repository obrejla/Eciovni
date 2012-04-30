<?php

namespace OndrejBrejla\Eciovni;

use Nette\Templating\ITemplate;
use mPDF;

/**
 * Eciovni - plugin for Nette Framework for generating invoices using mPDF library.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class Eciovni extends Control {

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
        $sum = 0;
        foreach ($this->data->items as $item) {
            $sum += $item->countUntaxedUnitValue() * $item->getUnits();
        }
        return $sum;
    }

    /**
     * Counts final tax value of all items.
     *
     * @return int
     */
    public function countFinalTaxValue() {
        $sum = 0;
        foreach ($this->data->items as $item) {
            $sum += $item->countTaxValue();
        }
        return $sum;
    }

    /**
     * Counts final value of all items.
     *
     * @return int
     */
    public function countFinalValues() {
        $sum = 0;
        foreach ($this->data->items as $item) {
            $sum += $item->countFinalValue();
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
        $this->generate($this->template);
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
     * Renderers the invoice to the defined template.
     *
     * @return void
     */
    public function render() {
        $this->generate($this->template);
        $this->template->render();
    }

    /**
     * Generates the invoice to the defined template.
     *
     * @return void
     */
    private function generate(ITemplate $template) {
        $template->setFile(dirname(__FILE__) . '/Eciovni.latte');
        $template->registerHelper('round', function($value, $precision = 2) {
            return number_format(round($value, $precision), 2, ',', '');
        });

        $template->title = $this->data->getTitle();
        $template->id = $this->data->getId();
        $template->items = $this->data->getItems();
        $this->geterateSupplier($template);
        $this->generateCustomer($template);
        $this->generateDates($template);
        $this->generateSymbols($template);
        $this->generateFinalValues($template);
    }

    /**
     * Generates supplier data into template.
     */
    private function geterateSupplier(ITemplate $template) {
        $supplier = $this->data->getSupplier();
        $template->supplierName = $supplier->getName();
        $template->supplierStreet = $supplier->getStreet();
        $template->supplierHouseNumber = $supplier->getHouseNumber();
        $template->supplierCity = $supplier->getCity();
        $template->supplierZip = $supplier->getZip();
        $template->supplierIn = $supplier->getIn();
        $template->supplierTin = $supplier->getTin();
        $template->supplierAccountNumber = $supplier->getAccountNumber();
    }

    /**
     * Generates customer data into template.
     */
    private function generateCustomer(ITemplate $template) {
        $customer = $this->data->getCustomer();
        $template->customerName = $customer->getName();
        $template->customerStreet = $customer->getStreet();
        $template->customerHouseNumber = $customer->getHouseNumber();
        $template->customerCity = $customer->getCity();
        $template->customerZip = $customer->getZip();
        $template->customerIn = $customer->getIn();
        $template->customerTin = $customer->getTin();
        $template->customerAccountNumber = $customer->getAccountNumber();
    }

    /**
     * Generates dates into template.
     */
    private function generateDates(ITemplate $template) {
        $template->dateOfIssuance = $this->data->getDateOfIssuance();
        $template->expirationDate = $this->data->getExpirationDate();
        $template->dateOfVatRevenueRecognition = $this->data->getDateOfVatRevenueRecognition();
    }

    /**
     * Generates symbols into template.
     */
    private function generateSymbols(ITemplate $template) {
        $template->variableSymbol = $this->data->getVariableSymbol();
        $template->specificSymbol = $this->data->getSpecificSymbol();
        $template->constantSymbol = $this->data->getConstantSymbol();
    }

    /**
     * Generates final values into template.
     */
    private function generateFinalValues(ITemplate $template) {
        $template->finalUntaxedValue = $this->countFinalUntaxedValue();
        $template->finalTaxValue = $this->countFinalTaxValue();
        $template->finalValue = $this->countFinalValues();
    }

}