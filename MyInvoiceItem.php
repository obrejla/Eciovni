<?php

/**
 * MyInvoiceItem - part of Invoice control plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 * @package    Nette\Extras
 * @version    0.3.1
 */
class MyInvoiceItem extends Object implements IInvoiceItem {

    /** @var string */
    private $description;

    /** @var double */
    private $tax;

    /** @var double */
    private $unitValue;

    /** @var int */
    private $units;

    /** @var boolean */
    private $unitValueIsTaxed;

    /**
     * Initializes the Item.
     *
     * @param string $description
     * @param int $units
     * @param double $unitValue
     * @param double $tax
     * @param boolean $unitValueIsTaxed
     */
    public function __construct($description = '', $units = 0, $unitValue = 0, $tax = 1, $unitValueIsTaxed = TRUE) {
        $this->setDescription($description);
        $this->setUnits($units);
        $this->setUnitValue($unitValue);
        $this->setTax($tax);
        $this->setUnitValueIsTaxed($unitValueIsTaxed);
    }

    /**
     * Sets the description of the item.
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the description of the item.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the tax of item.
     *
     * @param double $tax
     * @return void
     */
    public function setTax($tax) {
        $this->tax = $tax;
    }

    /**
     * Returns the tax of the item.
     *
     * @return double
     */
    public function getTax() {
        return $this->tax;
    }

    /**
     * Sets the value of one unit of the item.
     *
     * @param double $unitValue
     * @return void
     */
    public function setUnitValue($unitValue) {
        $this->unitValue = $unitValue;
    }

    /**
     * Returns the value of one unit of the item.
     *
     * @return double
     */
    public function getUnitValue() {
        return $this->unitValue;
    }

    /**
     * Sets the unit value as taxed.
     *
     * @param boolean $isTaxed
     * @return void
     */
    public function setUnitValueIsTaxed($isTaxed) {
        $this->unitValueIsTaxed = $isTaxed;
    }

    /**
     * Returns TRUE, if the unit value is taxed (otherwise FALSE).
     *
     * @return boolean
     */
    public function isUnitValueTaxed() {
        return $this->unitValueIsTaxed;
    }

    /**
     * Sets the number of item units.
     *
     * @param int $units
     * @return void
     */
    public function setUnits($units) {
        $this->units = $units;
    }

    /**
     * Returns the number of item units.
     *
     * @return int
     */
    public function getUnits() {
        return $this->units;
    }

    /**
     * Returns the value of taxes for all units.
     *
     * @return double
     */
    public function getTaxValue() {
        return ($this->getTaxedUnitValue() - $this->getUntaxedUnitValue()) * $this->getUnits();
    }

    /**
     * Returns the taxed value of one unit.
     *
     * @return double
     */
    public function getTaxedUnitValue() {
        if ($this->isUnitValueTaxed()) {
            return $this->getUnitValue();
        } else {
            return $this->getUnitValue() * $this->getTax();
        }
    }

    /**
     * Returns the value of unit without tax.
     *
     * @return double
     */
    public function getUntaxedUnitValue() {
        if ($this->isUnitValueTaxed()) {
            return $this->getUnitValue() / $this->getTax();
        } else {
            return $this->getUnitValue();
        }
    }

    /**
     * Returns the final value of all taxed units.
     *
     * @return double
     */
    public function getFinalValue() {
        return $this->getUnits() * $this->getTaxedUnitValue();
    }
    
}