<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


/**
 * ItemImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       https://github.com/obrejla/Eciovni
 */
class ItemImpl
{
	private string $description;

	private int $units;

	private float $unitValue;

	private Tax $tax;

	private bool $unitValueIsTaxed;


	public function __construct(string $description, int $units, float $unitValue, Tax $tax, bool $unitValueIsTaxed = true)
	{
		$this->description = $description;
		$this->units = $units;
		$this->unitValue = $unitValue;
		$this->tax = $tax;
		$this->unitValueIsTaxed = $unitValueIsTaxed;
	}


	public function getDescription(): string
	{
		return $this->description;
	}


	public function getTax(): Tax
	{
		return $this->tax;
	}


	public function getUnitValue(): float
	{
		return $this->unitValue;
	}


	/**
	 * Returns TRUE, if the unit value is taxed (otherwise FALSE).
	 *
	 * @return bool
	 */
	public function isUnitValueTaxed(): bool
	{
		return $this->unitValueIsTaxed;
	}


	public function getUnits(): int
	{
		return $this->units;
	}


	public function countTaxValue(): float
	{
		return ($this->countTaxedUnitValue() - $this->countUntaxedUnitValue()) * $this->getUnits();
	}


	public function countUntaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitValue() / $this->getTax()->inUpperDecimal()
			: $this->getUnitValue();
	}


	public function countFinalValue(): float
	{
		return $this->getUnits() * $this->countTaxedUnitValue();
	}


	private function countTaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitValue()
			: $this->getUnitValue() * $this->getTax()->inUpperDecimal();
	}
}
