<?php

namespace OndrejBrejla\Eciovni;

/**
 * Item - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
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
    public function countTaxValue();

    /**
     * Returns the value of unit without tax.
     *
     * @return double
     */
    public function countUntaxedUnitValue();

    /**
     * Returns the final value of all taxed units.
     *
     * @return double
     */
    public function countFinalValue();

}
