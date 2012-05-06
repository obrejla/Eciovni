<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;

/**
 * ItemImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ItemImpl extends Object implements Item {

    /** @var string */
    private $description;

    /** @var Tax */
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
     * @param Tax $tax
     * @param boolean $unitValueIsTaxed
     */
    public function __construct($description, $units, $unitValue, Tax $tax, $unitValueIsTaxed = TRUE) {
        $this->description = $description;
        $this->units = $units;
        $this->unitValue = $unitValue;
        $this->tax = $tax;
        $this->unitValueIsTaxed = $unitValueIsTaxed;
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
     * Returns the tax of the item.
     *
     * @return Tax
     */
    public function getTax() {
        return $this->tax;
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
     * Returns TRUE, if the unit value is taxed (otherwise FALSE).
     *
     * @return boolean
     */
    public function isUnitValueTaxed() {
        return $this->unitValueIsTaxed;
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
    public function countTaxValue() {
        return ($this->countTaxedUnitValue() - $this->countUntaxedUnitValue()) * $this->getUnits();
    }

    /**
     * Returns the taxed value of one unit.
     *
     * @return double
     */
    private function countTaxedUnitValue() {
        if ($this->isUnitValueTaxed()) {
            return $this->getUnitValue();
        } else {
            return $this->getUnitValue() * $this->getTax()->inUpperDecimal();
        }
    }

    /**
     * Returns the value of unit without tax.
     *
     * @return double
     */
    public function countUntaxedUnitValue() {
        if ($this->isUnitValueTaxed()) {
            return $this->getUnitValue() / $this->getTax()->inUpperDecimal();
        } else {
            return $this->getUnitValue();
        }
    }

    /**
     * Returns the final value of all taxed units.
     *
     * @return double
     */
    public function countFinalValue() {
        return $this->getUnits() * $this->countTaxedUnitValue();
    }

}
