<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;

/**
 * Participant - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
interface Participant
{

	/**
	 * Returns the name of participant.
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Sets the street of participant.
	 *
	 * @return string
	 */
	public function getStreet(): string;

	/**
	 * Returns the house number of participant.
	 *
	 * @return string
	 */
	public function getHouseNumber(): string;

	/**
	 * Returns the city of participant.
	 *
	 * @return string
	 */
	public function getCity(): string;

	/**
	 * Returns the zip of participant.
	 *
	 * @return string
	 */
	public function getZip(): string;

	/**
	 * Returns the identification number of participant.
	 *
	 * @return string
	 */
	public function getIn(): string;

	/**
	 * Returns the tax identification number of participant.
	 *
	 * @return string
	 */
	public function getTin(): string;

	/**
	 * Returns the account number of participant.
	 *
	 * @return string
	 */
	public function getAccountNumber(): string;
}
