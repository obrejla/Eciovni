<?php

namespace OndrejBrejla\Eciovni;

/**
 * Data - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
interface Data {

    /**
     * Returns the invoice title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Returns the invoice id.
     *
     * @return string
     */
    public function getId();

    /**
     * Returns the invoice supplier.
     *
     * @return Participant
     */
    public function getSupplier();

    /**
     * Returns the invoice customer.
     *
     * @return Participant
     */
    public function getCustomer();

    /**
     * Returns the variable symbol.
     *
     * @return int
     */
    public function getVariableSymbol();

    /**
     * Returns the constant symbol.
     *
     * @return int
     */
    public function getConstantSymbol();

    /**
     * Returns the specific symbol.
     *
     * @return int
     */
    public function getSpecificSymbol();

    /**
     * Returns the expiration date in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getExpirationDate($format = 'd.m.Y');

    /**
     * Returns the date of issuance in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getDateOfIssuance($format = 'd.m.Y');

    /**
     * Returns the date of VAT revenue recognition in defined format.
     *
     * @param string $format
     * @return string
     */
    public function getDateOfVatRevenueRecognition($format = 'd.m.Y');

    /**
     * Returns the inovice round.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return decimal
     */
    public function getInoviceRound();
    
    /**
     * Returns the logo company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getLogo();
    
    /**
     * Returns the stamp company.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getStamp();

    /**
     * Returns the array of items.
     *
     * @return Item[]
     */
    public function getItems();

    /**
     * Returns the array of taxes.
     *
     * @return Taxes[]
     */
    public function getTaxes();

}
