<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * ParticipantBuilder - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ParticipantBuilder
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

	/** @var string|null */
	private $in;

	/** @var string|null */
	private $tin;

	/** @var string|null */
	private $accountNumber;


	public function __construct(string $name, string $street, ?string $houseNumber, string $city, string $zip)
	{
		if (preg_match('/^(.+)\s+([\d\/\-]+)$/', $street, $streetParser)) { // case like "Rubešova 10"
			$street = (string) $streetParser[1];
			$houseNumber = (string) $streetParser[2];
		}

		$this->name = trim($name);
		$this->street = trim($street);
		$this->houseNumber = trim($houseNumber ?? '');
		$this->city = trim($city);
		$this->zip = trim($zip);

		if ($houseNumber === null) {
			throw new \InvalidArgumentException('House number can not be empty. Did you mean street with house number?');
		}
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
	 * @return string|null
	 */
	public function getIn(): ?string
	{
		return $this->in;
	}


	/**
	 * Sets the identification number of participant.
	 *
	 * @param string $in
	 * @return ParticipantBuilder
	 */
	public function setIn(string $in): self
	{
		$this->in = $in;

		return $this;
	}


	/**
	 * Returns the tax identification number of participant.
	 *
	 * @return string|null
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}


	/**
	 * Sets the tax identification number of participant.
	 *
	 * @param string $tin
	 * @return ParticipantBuilder
	 */
	public function setTin(string $tin): self
	{
		$this->tin = $tin;

		return $this;
	}


	/**
	 * Returns the account number of participant.
	 *
	 * @return string|null
	 */
	public function getAccountNumber(): ?string
	{
		return $this->accountNumber;
	}


	/**
	 * Sets the account number of participant.
	 *
	 * @param string $accountNumber
	 * @return ParticipantBuilder
	 */
	public function setAccountNumber(string $accountNumber): self
	{
		$this->accountNumber = $accountNumber;

		return $this;
	}


	/**
	 * Returns new Participant.
	 *
	 * @return ParticipantImpl
	 */
	public function build(): ParticipantImpl
	{
		return new ParticipantImpl($this);
	}
}
