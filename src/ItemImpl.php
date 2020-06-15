<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * ItemImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class ItemImpl implements Item
{
	use SmartObject;

	/** @var string */
	private $description;

	/** @var int */
	private $units;

	/** @var float */
	private $unitValue;

	/** @var Tax */
	private $tax;

	/** @var bool */
	private $unitValueIsTaxed;


	/**
	 * @param string $description
	 * @param int $units
	 * @param float $unitValue
	 * @param Tax $tax
	 * @param bool $unitValueIsTaxed
	 */
	public function __construct(string $description, int $units, float $unitValue, Tax $tax, bool $unitValueIsTaxed = true)
	{
		$this->description = $description;
		$this->units = $units;
		$this->unitValue = $unitValue;
		$this->tax = $tax;
		$this->unitValueIsTaxed = $unitValueIsTaxed;
	}


	/**
	 * Returns the description of the item.
	 *
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}


	/**
	 * Returns the tax of the item.
	 *
	 * @return Tax
	 */
	public function getTax(): Tax
	{
		return $this->tax;
	}


	/**
	 * Returns the value of one unit of the item.
	 *
	 * @return float
	 */
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


	/**
	 * Returns the number of item units.
	 *
	 * @return int
	 */
	public function getUnits(): int
	{
		return $this->units;
	}


	/**
	 * Returns the value of taxes for all units.
	 *
	 * @return float
	 */
	public function countTaxValue(): float
	{
		return ($this->countTaxedUnitValue() - $this->countUntaxedUnitValue()) * $this->getUnits();
	}


	/**
	 * Returns the value of unit without tax.
	 *
	 * @return float
	 */
	public function countUntaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitValue() / $this->getTax()->inUpperDecimal()
			: $this->getUnitValue();
	}


	/**
	 * Returns the final value of all taxed units.
	 *
	 * @return float
	 */
	public function countFinalValue(): float
	{
		return $this->getUnits() * $this->countTaxedUnitValue();
	}


	/**
	 * Returns the taxed value of one unit.
	 *
	 * @return float
	 */
	private function countTaxedUnitValue(): float
	{
		return $this->isUnitValueTaxed()
			? $this->getUnitValue()
			: $this->getUnitValue() * $this->getTax()->inUpperDecimal();
	}
}
