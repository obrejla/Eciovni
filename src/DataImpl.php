<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


class DataImpl
{
	public const DATE_FORMAT = 'd. m. Y';

	private string $title;

	private string $id;

	private Participant $supplier;

	private Participant $customer;

	private ?string $variableSymbol = null;

	private ?string $constantSymbol = null;

	private ?string $specificSymbol = null;

	private \DateTimeInterface $dueDate;

	private \DateTimeInterface $createdDate;

	private ?\DateTimeInterface $dateOfVatRevenueRecognition = null;

	private ?string $textBottom = null;

	private ?string $unit = null;

	/** @var ItemImpl[] */
	private array $items = [];

	private ?string $paymentMethod = null;


	/**
	 * @param ItemImpl[] $items
	 */
	public function __construct(
		string $id,
		string $title,
		Participant $supplier,
		Participant $customer,
		\DateTimeInterface $expirationDate,
		\DateTimeInterface $dateOfIssuance,
		array $items
	) {
		$this->setId($id);
		$this->setTitle($title);
		$this->setSupplier($supplier);
		$this->setCustomer($customer);
		$this->setDueDate($expirationDate);
		$this->setCreatedDate($dateOfIssuance);
		$this->setItems($items);
	}


	/**
	 * @param ItemImpl[] $items
	 */
	public static function from(
		string $id,
		string $title,
		Participant $supplier,
		Participant $customer,
		\DateTimeInterface $dueDate,
		\DateTimeInterface $createdDate,
		array $items
	): self {
		return new self($id, $title, $supplier, $customer, $dueDate, $createdDate, $items);
	}


	public function getTitle(): string
	{
		return $this->title;
	}


	public function setTitle(string $title): void
	{
		$this->title = $title;
	}


	public function getId(): string
	{
		return $this->id;
	}


	public function setId(string $id): void
	{
		$this->id = $id;
	}


	public function getSupplier(): Participant
	{
		return $this->supplier;
	}


	public function setSupplier(Participant $supplier): void
	{
		$this->supplier = $supplier;
	}


	public function getCustomer(): Participant
	{
		return $this->customer;
	}


	public function setCustomer(Participant $customer): void
	{
		$this->customer = $customer;
	}


	public function getVariableSymbol(): string
	{
		return $this->variableSymbol ?? '0';
	}


	public function setVariableSymbol(?string $variableSymbol): self
	{
		$this->variableSymbol = $variableSymbol;

		return $this;
	}


	public function getConstantSymbol(): string
	{
		return $this->constantSymbol ?? '0';
	}


	public function setConstantSymbol(?string $constantSymbol): self
	{
		$this->constantSymbol = $constantSymbol;

		return $this;
	}


	public function getSpecificSymbol(): string
	{
		return $this->specificSymbol ?? '0';
	}


	public function setSpecificSymbol(?string $specificSymbol): self
	{
		$this->specificSymbol = $specificSymbol;

		return $this;
	}


	public function getDueDate(string $format = self::DATE_FORMAT): string
	{
		return $this->dueDate->format($format);
	}


	public function setDueDate(\DateTimeInterface $dueDate): void
	{
		$this->dueDate = $dueDate;
	}


	public function getCreatedDate(string $format = self::DATE_FORMAT): string
	{
		return $this->createdDate->format($format);
	}


	public function setCreatedDate(\DateTimeInterface $createdDate): void
	{
		$this->createdDate = $createdDate;
	}


	public function getDateOfVatRevenueRecognition(string $format = self::DATE_FORMAT): string
	{
		return $this->dateOfVatRevenueRecognition === null
			? ''
			: $this->dateOfVatRevenueRecognition->format($format);
	}


	public function setDateOfVatRevenueRecognition(?\DateTimeInterface $date): void
	{
		$this->dateOfVatRevenueRecognition = $date;
	}


	public function getTextBottom(): ?string
	{
		return $this->textBottom;
	}


	public function setTextBottom(?string $textBottom): self
	{
		$this->textBottom = trim($textBottom ?? '') ?: null;

		return $this;
	}


	/**
	 * @param ItemImpl[] $items
	 */
	public function addItems(array $items): self
	{
		foreach ($items as $item) {
			$this->addItem($item);
		}

		return $this;
	}


	/**
	 * @return ItemImpl[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}


	/**
	 * @param ItemImpl[] $items
	 */
	public function setItems(array $items): void
	{
		$this->items = $items;
	}


	public function addItem(ItemImpl $item): self
	{
		$this->items[] = $item;

		return $this;
	}


	public function getUnit(): ?string
	{
		return $this->unit;
	}


	public function setUnit(?string $unit): void
	{
		$this->unit = $unit;
	}


	public function getTaxValueSum(): float
	{
		$sum = 0;
		foreach ($this->getItems() as $item) {
			$sum += $item->countTaxValue();
		}

		return $sum;
	}


	public function getUntaxedUnitValueSum(): float
	{
		$sum = 0;
		foreach ($this->getItems() as $item) {
			$sum += $item->countUntaxedUnitValue();
		}

		return $sum;
	}


	public function getFinalValueSum(): float
	{
		$sum = 0;
		foreach ($this->getItems() as $item) {
			$sum += $item->countFinalValue();
		}

		return $sum;
	}


	public function getPaymentMethod(): ?string
	{
		return $this->paymentMethod;
	}


	public function setPaymentMethod(?string $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}
}
