<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


interface Participant
{
	public function getName(): string;

	public function getStreet(): string;

	public function getHouseNumber(): string;

	public function getCity(): string;

	public function getZip(): string;

	public function getIn(): ?string;

	/** Returns the tax identification number of participant. */
	public function getTin(): ?string;

	public function getAccountNumber(): ?string;

	public function getSupplierAddressDescription(): ?string;
}
