<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * ParticipantImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ParticipantImpl implements Participant
{
	use SmartObject;

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


	public function __construct(ParticipantBuilder $participantBuilder)
	{
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
	public function getName(): string
	{
		return $this->name;
	}


	/**
	 * Returns the street of participant.
	 *
	 * @return string
	 */
	public function getStreet(): string
	{
		return $this->street;
	}


	/**
	 * Returns the house number of participant.
	 *
	 * @return string
	 */
	public function getHouseNumber(): string
	{
		return $this->houseNumber;
	}


	/**
	 * Returns the city of participant.
	 *
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}


	/**
	 * Returns the zip of participant.
	 *
	 * @return string
	 */
	public function getZip(): string
	{
		return $this->zip;
	}


	/**
	 * Returns the identification number of participant.
	 *
	 * @return string
	 */
	public function getIn(): string
	{
		return $this->in;
	}


	/**
	 * Returns the tax identification number of participant.
	 *
	 * @return string
	 */
	public function getTin(): string
	{
		return $this->tin;
	}


	/**
	 * Returns the account number of participant.
	 *
	 * @return string
	 */
	public function getAccountNumber(): string
	{
		return $this->accountNumber;
	}
}
