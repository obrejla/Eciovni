<?php

/**
 * MyInvoiceParticipant - part of Invoice control plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Nette-InvoiceControl
 * @package    Nette\Extras
 * @version    0.3.1
 */
class MyInvoiceParticipant extends Object implements IInvoiceParticipant {
    
    /** @var string */
    private $name;

    /** @var street */
    private $street;

    /** @var string */
    private $houseNumber;

    /** @var string */
    private $city;

    /** @var string */
    private $zip;

    /** @var string */
    private $in;

    /** @var string */
    private $tin;

    /** @var string */
    private $accountNumber;

    /**
     * Initializes the Participant.
     *
     * @param string $name
     * @param string $street
     * @param string $houseNumber
     * @param string $city
     * @param string $zip
     * @param string $in
     * @param string $tin
     * @param string $accountNumber
     */
    public function __construct($name, $street, $houseNumber, $city, $zip, $in, $tin, $accountNumber) {
        $this->setName($name);
        $this->setStreet($street);
        $this->setHouseNumber($houseNumber);
        $this->setCity($city);
        $this->setZip($zip);
        $this->setIn($in);
        $this->setTin($tin);
        $this->setAccountNumber($accountNumber);
    }

    /**
     * Sets the name of participant.
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the name of participant.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the street of participant.
     *
     * @param string $street
     * @return void
     */
    public function setStreet($street) {
        $this->street = $street;
    }

    /**
     * Returns the street of participant.
     *
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Sets the house number of participant.
     *
     * @param string $houseNumber
     * @return void
     */
    public function setHouseNumber($houseNumber) {
        $this->houseNumber = $houseNumber;
    }

    /**
     * Returns the house number of participant.
     *
     * @return string
     */
    public function getHouseNumber() {
        return $this->houseNumber;
    }

    /**
     * Sets the city of participant.
     *
     * @param string $city
     * @return void
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * Returns the city of participant.
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Sets the zip of participant.
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip) {
        $this->zip = $zip;
    }

    /**
     * Returns the zip of participant.
     *
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Sets the identification number of participant.
     *
     * @param string $in
     * @return void
     */
    public function setIn($in) {
        $this->in = $in;
    }

    /**
     * Returns the identification number of participant.
     *
     * @return string
     */
    public function getIn() {
        return $this->in;
    }

    /**
     * Sets the tax identification number of participant.
     *
     * @param string $tin
     * @return void
     */
    public function setTin($tin) {
        $this->tin = $tin;
    }

    /**
     * Returns the tax identification number of participant.
     *
     * @return string
     */
    public function getTin() {
        return $this->tin;
    }

    /**
     * Sets the account number of participant.
     *
     * @param string $accountNumber
     * @return void
     */
    public function setAccountNumber($accountNumber) {
        $this->accountNumber = $accountNumber;
    }

    /**
     * Returns the account number of participant.
     *
     * @return string
     */
    public function getAccountNumber() {
        return $this->accountNumber;
    }
    
}