<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * DataImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class DataImpl implements Data
{
	use SmartObject;

	/** @var string */
	private $title;

	/** @var string */
	private $id;

	/** @var Participant */
	private $supplier;

	/** @var Participant */
	private $customer;

	/** @var string */
	private $variableSymbol;

	/** @var string */
	private $constantSymbol;

	/** @var string */
	private $specificSymbol;

	/** @var \DateTime */
	private $expirationDate;

	/** @var \DateTime */
	private $dateOfIssuance;

	/** @var \DateTime */
	private $dateOfVatRevenueRecognition;

	/** @var Item[] */
	private $items;

	/** @var string|null */
	private $paymentMethod;


	public function __construct(DataBuilder $dataBuilder)
	{
		$this->title = $dataBuilder->getTitle();
		$this->id = $dataBuilder->getId();
		$this->supplier = $dataBuilder->getSupplier();
		$this->customer = $dataBuilder->getCustomer();
		$this->variableSymbol = $dataBuilder->getVariableSymbol();
		$this->constantSymbol = $dataBuilder->getConstantSymbol();
		$this->specificSymbol = $dataBuilder->getSpecificSymbol();
		$this->expirationDate = $dataBuilder->getExpirationDate();
		$this->dateOfIssuance = $dataBuilder->getDateOfIssuance();
		$this->dateOfVatRevenueRecognition = $dataBuilder->getDateOfVatRevenueRecognition();
		$this->items = $dataBuilder->getItems();
		$this->paymentMethod = $dataBuilder->getPaymentMethod();
	}


	/**
	 * Returns the invoice title.
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}


	/**
	 * Returns the invoice id.
	 *
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}


	/**
	 * Returns the invoice supplier.
	 *
	 * @return Participant
	 */
	public function getSupplier(): Participant
	{
		return $this->supplier;
	}


	/**
	 * Returns the invoice customer.
	 *
	 * @return Participant
	 */
	public function getCustomer(): Participant
	{
		return $this->customer;
	}


	/**
	 * Returns the variable symbol.
	 *
	 * @return string
	 */
	public function getVariableSymbol(): string
	{
		return $this->variableSymbol;
	}


	/**
	 * Returns the constant symbol.
	 *
	 * @return string
	 */
	public function getConstantSymbol(): string
	{
		return $this->constantSymbol;
	}


	/**
	 * Returns the specific symbol.
	 *
	 * @return string
	 */
	public function getSpecificSymbol(): string
	{
		return $this->specificSymbol;
	}


	/**
	 * Returns the expiration date in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getExpirationDate(string $format = self::DATE_FORMAT): string
	{
		return $this->expirationDate->format($format);
	}


	/**
	 * Returns the date of issuance in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getDateOfIssuance(string $format = self::DATE_FORMAT): string
	{
		return $this->dateOfIssuance->format($format);
	}


	/**
	 * Returns the date of VAT revenue recognition in defined format.
	 *
	 * @param string $format
	 * @return string
	 */
	public function getDateOfVatRevenueRecognition(string $format = self::DATE_FORMAT): string
	{
		return $this->dateOfVatRevenueRecognition === null ? '' : $this->dateOfVatRevenueRecognition->format($format);
	}


	/**
	 * Returns the array of items.
	 *
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}


	/**
	 * @return string|null
	 */
	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}
}
