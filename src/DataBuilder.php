<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * DataBuilder - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class DataBuilder
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
	private $variableSymbol = '0';

	/** @var string */
	private $constantSymbol = '0';

	/** @var string */
	private $specificSymbol = '0';

	/** @var \DateTime */
	private $expirationDate;

	/** @var \DateTime */
	private $dateOfIssuance;

	/** @var \DateTime */
	private $dateOfVatRevenueRecognition;

	/** @var Item[] */
	private $items = [];

	/** @var string|null */
	private $paymentMethod;


	/**
	 * @param Item[] $items
	 */
	public function __construct(string $id, string $title, Participant $supplier, Participant $customer, \DateTime $expirationDate, \DateTime $dateOfIssuance, array $items)
	{
		$this->id = $id;
		$this->title = $title;
		$this->supplier = $supplier;
		$this->customer = $customer;
		$this->expirationDate = $expirationDate;
		$this->dateOfIssuance = $dateOfIssuance;
		$this->addItems($items);
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
	 * Sets the variable symbol.
	 *
	 * @param string $variableSymbol
	 * @return DataBuilder
	 */
	public function setVariableSymbol(string $variableSymbol): self
	{
		$this->variableSymbol = $variableSymbol;

		return $this;
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
	 * Sets the constant symbol.
	 *
	 * @param string $constantSymbol
	 * @return DataBuilder
	 */
	public function setConstantSymbol(string $constantSymbol): self
	{
		$this->constantSymbol = $constantSymbol;

		return $this;
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
	 * Sets the specific symbol.
	 *
	 * @param string $specificSymbol
	 * @return DataBuilder
	 */
	public function setSpecificSymbol(string $specificSymbol): self
	{
		$this->specificSymbol = $specificSymbol;

		return $this;
	}


	/**
	 * Returns the expiration date in defined format.
	 *
	 * @return \DateTime
	 */
	public function getExpirationDate(): \DateTime
	{
		return $this->expirationDate;
	}


	/**
	 * Returns the date of issuance in defined format.
	 *
	 * @return \DateTime
	 */
	public function getDateOfIssuance(): \DateTime
	{
		return $this->dateOfIssuance;
	}


	/**
	 * Returns the date of VAT revenue recognition in defined format.
	 *
	 * @return \DateTime
	 */
	public function getDateOfVatRevenueRecognition(): \DateTime
	{
		return $this->dateOfVatRevenueRecognition;
	}


	/**
	 * Sets the date of VAT revenue recognition.
	 *
	 * @param \DateTime $dateOfTaxablePayment
	 * @return DataBuilder
	 */
	public function setDateOfVatRevenueRecognition(\DateTime $dateOfTaxablePayment): self
	{
		$this->dateOfVatRevenueRecognition = $dateOfTaxablePayment;

		return $this;
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
	 * Returns new Data.
	 *
	 * @return DataImpl
	 */
	public function build(): DataImpl
	{
		return new DataImpl($this);
	}


	/**
	 * @return string|null
	 */
	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}


	/**
	 * @param string|null $paymentMethod
	 */
	public function setPaymentMethod(?string $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}


	/**
	 * Adds array of items to the invoice.
	 *
	 * @param Item[] $items
	 */
	private function addItems(array $items): void
	{
		foreach ($items as $item) {
			$this->addItem($item);
		}
	}


	/**
	 * Adds an item to the invoice.
	 *
	 * @param Item $item
	 */
	private function addItem(Item $item): void
	{
		$this->items[] = $item;
	}
}
