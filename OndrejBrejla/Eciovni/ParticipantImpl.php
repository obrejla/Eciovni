<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;

/**
 * ParticipantImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ParticipantImpl extends Object implements Participant {

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
    private $in;

    /** @var string */
    private $tin;

    /** @var string */
    private $accountNumber;

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
     * Initializes the Participant.
     *
     * @param ParticipantBuilder $participantBuilder
     */
    public function __construct(ParticipantBuilder $participantBuilder) {
        $this->name = $participantBuilder->getName();
        $this->street = $participantBuilder->getStreet();
        $this->houseNumber = $participantBuilder->getHouseNumber();
        $this->city = $participantBuilder->getCity();
        $this->zip = $participantBuilder->getZip();
        $this->in = $participantBuilder->getIn();
        $this->tin = $participantBuilder->getTin();
        $this->accountNumber = $participantBuilder->getAccountNumber();
        $this->bankName = $participantBuilder->getBankName();
        $this->payment = $participantBuilder->getPayment();
        $this->registration = $participantBuilder->getRegistration();
        $this->vatPayer = $participantBuilder->getVatPayer();
        $this->order = $participantBuilder->getOrder();
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
}
