<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;

/**
 * Participant - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       https://github.com/obrejla/Eciovni
 */
interface Participant
{
	public function getName(): string;

	public function getStreet(): string;

	public function getHouseNumber(): string;

	public function getCity(): string;

	public function getZip(): string;

	public function getIn(): ?string;

	/**
	 * Returns the tax identification number of participant.
	 *
	 * @return string|null
	 */
	public function getTin(): ?string;

	public function getAccountNumber(): ?string;
}
