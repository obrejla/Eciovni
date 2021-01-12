<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


class ItemImpl
{
	private string $description;

	private int $count;

	private float $unitPrice;

	private Tax $tax;

	private bool $unitValueIsTaxed;


	public function __construct(string $description, int $count, float $unitPrice, Tax $tax, bool $unitPriceIsTaxed = true)
	{
		$this->description = $description;
		$this->count = $count;
		$this->unitPrice = $unitPrice;
		$this->tax = $tax;
		$this->unitValueIsTaxed = $unitPriceIsTaxed;
	}


	public function getDescription(): string
	{
		return $this->description;
	}


	public function getTax(): Tax
	{
		return $this->tax;
	}


	public function getUnitPrice(): float
	{
		return $this->unitPrice;
	}


	/**
	 * @deprecated since 2021-01-12 use getUnitPrice().
	 */
	public function getUnitValue(): float
	{
		return $this->getUnitPrice();
	}


	/**
	 * Returns TRUE, if the unit value is taxed (otherwise FALSE).
	 */
	public function isUnitValueTaxed(): bool
	{
		return $this->unitValueIsTaxed;
	}


	public function getCount(): int
	{
		return $this->count;
	}


	/**
	 * @deprecated since 2021-01-12 use getCount().
	 */
	public function getUnits(): int
	{
		return $this->getCount();
	}


	public function countTaxValue(): float
	{
		return ($this->countTaxedUnitValue() - $this->countUntaxedUnitValue()) * $this->getCount();
	}


	public function countUntaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitPrice() / $this->getTax()->inUpperDecimal()
			: $this->getUnitPrice();
	}


	public function countFinalValue(): float
	{
		return $this->getCount() * $this->countTaxedUnitValue();
	}


	private function countTaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitPrice()
			: $this->getUnitPrice() * $this->getTax()->inUpperDecimal();
	}
}
