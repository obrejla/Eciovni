<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


/**
 * Data - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
interface Data
{
	public const DATE_FORMAT = 'd. m. Y';

	/**
	 * Returns the invoice title.
	 *
	 * @return string
	 */
	public function getTitle(): string;

	/**
	 * Returns the invoice id.
	 *
	 * @return string
	 */
	public function getId(): string;

	/**
	 * Returns the invoice supplier.
	 *
	 * @return Participant
	 */
	public function getSupplier(): Participant;

	/**
	 * Returns the invoice customer.
	 *
	 * @return Participant
	 */
	public function getCustomer(): Participant;

	/**
	 * Returns the variable symbol.
	 *
	 * @return string
	 */
	public function getVariableSymbol(): string;

	/**
	 * Returns the constant symbol.
	 *
	 * @return string
	 */
	public function getConstantSymbol(): string;

	/**
	 * Returns the specific symbol.
	 *
	 * @return string
	 */
	public function getSpecificSymbol(): string;

	/**
	 * Returns the expiration date in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getExpirationDate(string $format = 'd.m.Y'): string;

	/**
	 * Returns the date of issuance in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getDateOfIssuance(string $format = 'd.m.Y'): string;

	/**
	 * Returns the date of VAT revenue recognition in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getDateOfVatRevenueRecognition(string $format = 'd.m.Y'): string;

	/**
	 * Returns the array of items.
	 *
	 * @return Item[]
	 */
	public function getItems(): array;

	public function getPaymentMethod(): ?string;
}
