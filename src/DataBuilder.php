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

	/** @var string|null */
	private $variableSymbol;

	/** @var string|null */
	private $constantSymbol;

	/** @var string|null */
	private $specificSymbol;

	/** @var \DateTime */
	private $expirationDate;

	/** @var \DateTime */
	private $dateOfIssuance;

	/** @var \DateTime|null */
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


	public function getTitle(): string
	{
		return $this->title;
	}


	public function getId(): string
	{
		return $this->id;
	}


	public function getSupplier(): Participant
	{
		return $this->supplier;
	}


	public function getCustomer(): Participant
	{
		return $this->customer;
	}


	public function getVariableSymbol(): string
	{
		return $this->variableSymbol ?? '0';
	}


	public function setVariableSymbol(string $variableSymbol): self
	{
		$this->variableSymbol = $variableSymbol;

		return $this;
	}


	public function getConstantSymbol(): string
	{
		return $this->constantSymbol ?? '0';
	}


	public function setConstantSymbol(string $constantSymbol): self
	{
		$this->constantSymbol = $constantSymbol;

		return $this;
	}


	public function getSpecificSymbol(): string
	{
		return $this->specificSymbol ?? '0';
	}


	public function setSpecificSymbol(string $specificSymbol): self
	{
		$this->specificSymbol = $specificSymbol;

		return $this;
	}


	public function getExpirationDate(): \DateTime
	{
		return $this->expirationDate;
	}


	public function getDateOfIssuance(): \DateTime
	{
		return $this->dateOfIssuance;
	}


	public function getDateOfVatRevenueRecognition(): ?\DateTime
	{
		return $this->dateOfVatRevenueRecognition;
	}


	public function setDateOfVatRevenueRecognition(\DateTime $dateOfTaxablePayment): self
	{
		$this->dateOfVatRevenueRecognition = $dateOfTaxablePayment;

		return $this;
	}


	/**
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


	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}


	public function setPaymentMethod(?string $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}


	/**
	 * @param Item[] $items
	 */
	private function addItems(array $items): void
	{
		foreach ($items as $item) {
			$this->addItem($item);
		}
	}


	/**
	 * @param Item $item
	 */
	private function addItem(Item $item): void
	{
		$this->items[] = $item;
	}
}
