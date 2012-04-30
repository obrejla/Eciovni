<?php

namespace OndrejBrejla\NetteInvoiceControl;

/**
 * Item - part of Invoice control plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 */
interface Item {

    /**
     * Returns the description of the item.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Returns the tax of the item.
     *
     * @return double
     */
    public function getTax();

    /**
     * Returns the value of one unit of the item.
     *
     * @return double
     */
    public function getUnitValue();

    /**
     * Returns the number of item units.
     *
     * @return int
     */
    public function getUnits();

    /**
     * Returns the value of taxes for all units.
     *
     * @return double
     */
    public function getTaxValue();

    /**
     * Returns the taxed value of one unit.
     *
     * @return double
     */
    public function getTaxedUnitValue();

    /**
     * Returns the value of unit without tax.
     *
     * @return double
     */
    public function getUntaxedUnitValue();

    /**
     * Returns the final value of all taxed units.
     *
     * @return double
     */
    public function getFinalValue();

}

