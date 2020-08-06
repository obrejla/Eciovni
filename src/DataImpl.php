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
		return $this->variableSymbol;
	}


	public function getConstantSymbol(): string
	{
		return $this->constantSymbol;
	}


	public function getSpecificSymbol(): string
	{
		return $this->specificSymbol;
	}


	public function getExpirationDate(string $format = Data::DATE_FORMAT): string
	{
		return $this->expirationDate->format($format);
	}


	public function getDateOfIssuance(string $format = Data::DATE_FORMAT): string
	{
		return $this->dateOfIssuance->format($format);
	}


	public function getDateOfVatRevenueRecognition(string $format = Data::DATE_FORMAT): string
	{
		return $this->dateOfVatRevenueRecognition === null ? '' : $this->dateOfVatRevenueRecognition->format($format);
	}


	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}


	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}
}
