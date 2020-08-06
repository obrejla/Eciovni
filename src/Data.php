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

	public function getTitle(): string;

	public function getId(): string;

	public function getSupplier(): Participant;

	public function getCustomer(): Participant;

	public function getVariableSymbol(): string;

	public function getConstantSymbol(): string;

	public function getSpecificSymbol(): string;

	/**
	 * Returns the expiration date in defined format.
	 */
	public function getExpirationDate(string $format = 'd.m.Y'): string;

	/**
	 * Returns the date of issuance in defined format.
	 */
	public function getDateOfIssuance(string $format = 'd.m.Y'): string;

	/**
	 * Returns the date of VAT revenue recognition in defined format.
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
