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

}
