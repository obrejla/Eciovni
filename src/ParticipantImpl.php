<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


/**
 * ParticipantImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       https://github.com/obrejla/Eciovni
 */
class ParticipantImpl implements Participant
{
	private string $name;

	private string $street;

	private string $houseNumber;

	private string $city;

	private string $zip;

	private ?string $in;

	private ?string $tin;

	private ?string $accountNumber;


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


	public function getName(): string
	{
		return $this->name;
	}


	public function getStreet(): string
	{
		return $this->street;
	}


	public function getHouseNumber(): string
	{
		return $this->houseNumber;
	}


	public function getCity(): string
	{
		return $this->city;
	}


	public function getZip(): string
	{
		return $this->zip;
	}


	/**
	 * Returns the identification number of participant.
	 */
	public function getIn(): ?string
	{
		return $this->in;
	}


	/**
	 * Returns the tax identification number of participant.
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}


	public function getAccountNumber(): ?string
	{
		return $this->accountNumber;
	}
}
