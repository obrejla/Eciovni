<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


class ParticipantBuilder
{
	public const STREET_VALIDATOR = '/^(.+)\s+([\d\/\-]+[a-zA-Z]*)$/';

	private string $name;

	private string $street;

	private string $houseNumber;

	private string $city;

	private string $zip;

	private ?string $in = null;

	private ?string $tin = null;

	private ?string $accountNumber = null;

	private ?string $supplierAddressDescription = null;


	public function __construct(string $name, string $street, ?string $houseNumber, string $city, string $zip)
	{
		if (preg_match(self::STREET_VALIDATOR, $street, $streetParser)) { // case like "Rubešova 10"
			$street = (string) $streetParser[1];
			$houseNumber = (string) $streetParser[2];
		} elseif (preg_match('/^([\d\/\-]+[a-zA-Z]*)\s+(.+)$/', $street, $streetParserInverse)) { // case like "1505 R. Novotného"
			$street = (string) $streetParserInverse[2];
			$houseNumber = (string) $streetParserInverse[1];
		}

		$this->name = trim($name);
		$this->street = trim($street);
		$this->houseNumber = trim($houseNumber ?? '');
		$this->city = trim($city);
		$this->zip = trim($zip);

		if ($houseNumber === null) {
			trigger_error('House number can not be empty. Did you mean street with house number?');
		}
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
	 * Sets the identification number of participant.
	 */
	public function setIn(string $in): self
	{
		$this->in = $in;

		return $this;
	}


	/**
	 * Returns the tax identification number of participant.
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}


	/**
	 * Sets the tax identification number of participant.
	 */
	public function setTin(string $tin): self
	{
		$this->tin = $tin;

		return $this;
	}


	public function getAccountNumber(): ?string
	{
		return $this->accountNumber;
	}


	public function setAccountNumber(string $accountNumber): self
	{
		$this->accountNumber = $accountNumber;

		return $this;
	}


	public function getSupplierAddressDescription(): ?string
	{
		return $this->supplierAddressDescription;
	}


	public function setSupplierAddressDescription(?string $supplierAddressDescription): self
	{
		$this->supplierAddressDescription = $supplierAddressDescription;

		return $this;
	}


	public function build(): ParticipantImpl
	{
		return new ParticipantImpl($this);
	}
}
