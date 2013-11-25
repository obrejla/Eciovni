<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;

/**
 * ParticipantBuilder - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ParticipantBuilder extends Object {

    /** @var string */
    private $name;

    /** @var string */
    private $street;

    /** @var string */
    private $houseNumber;

    /** @var string */
    private $city;

    /** @var string */
    private $zip;

    /** @var string */
    private $in = NULL;

    /** @var string */
    private $tin = NULL;

    /** @var string */
    private $accountNumber = NULL;

    /** @var string */
    private $bankName = NULL;

    /** @var string */
    private $payment = NULL;
    
    /** @var string */
    private $registration = NULL;
    
    /** @var bool */
    private $vatPayer = NULL;
    
    /** @var string */
    private $order = NULL;

    /**
     * Initializes the Participant builder.
     *
     * @param string $name
     * @param string $street
     * @param string $houseNumber
     * @param string $city
     * @param string $zip
     */
    public function __construct($name, $street, $houseNumber, $city, $zip) {
        $this->name = $name;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->city = $city;
        $this->zip = $zip;
    }

    /**
     * Sets the identification number of participant.
     *
     * @param string $in
     * @return ParticipantBuilder
     */
    public function setIn($in) {
        $this->in = $in;
        return $this;
    }

    /**
     * Sets the tax identification number of participant.
     *
     * @param string $tin
     * @return ParticipantBuilder
     */
    public function setTin($tin) {
        $this->tin = $tin;
        return $this;
    }

    /**
     * Sets the account number of participant.
     *
     * @param string $accountNumber
     * @return ParticipantBuilder
     */
    public function setAccountNumber($accountNumber) {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * Sets the bank name of participant.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $bankName
     * @return ParticipantBuilder
     */
    public function setBankName($bankName) {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * Sets the payment.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $payment
     * @return ParticipantBuilder
     */
    public function setPayment($payment) {
        $this->payment = $payment;
        return $this;
    }
    
    /**
     * Sets the registration.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $registration
     * @return ParticipantBuilder
     */
    public function setRegistration($registration) {
        $this->registration = $registration;
        return $this;
    }
    
    /**
     * Sets the vat payper.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param bool $vatPayer
     * @return ParticipantBuilder
     */
    public function setVatPayer($vatPayer) {
        $this->vatPayer = $vatPayer;
        return $this;
    }
    
    /**
     * Sets the number order.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @param string $order
     * @return ParticipantBuilder
     */
    public function setOrder($order) {
        $this->order = $order;
        return $this;
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
     * Returns the street of participant.
     *
     * @return string
     */
    public function getStreet() {
        return $this->street;
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
     * Returns the city of participant.
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
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
     * Returns the identification number of participant.
     *
     * @return string
     */
    public function getIn() {
        return $this->in;
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
     * Returns the account number of participant.
     *
     * @return string
     */
    public function getAccountNumber() {
        return $this->accountNumber;
    }

    /**
     * Returns the bank name of participant.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getBankName() {
        return $this->bankName;
    }

    /**
     * Returns the payment.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getPayment() {
        return $this->payment;
    }
    
    /**
     * Returns the registration.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getRegistration() {
        return $this->registration;
    }

    /**
     * Returns the vat payper.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return bool
     */
    public function getVatPayer() {
        return $this->vatPayer;
    }
    
    /**
     * Returns the order number.
     *
     * @author Petr Láslo <petr.laslo@gmail.com>
     * @return string
     */
    public function getOrder() {
        return $this->order;
    }
    
    /**
     * Returns new Participant.
     *
     * @return Participant
     */
    public function build() {
        return new ParticipantImpl($this);
    }

}
