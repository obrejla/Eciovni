<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;

/**
 * Item - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
interface Item
{
	public function getDescription(): string;

	public function getTax(): Tax;

	public function getUnitValue(): float;

	public function getUnits(): int;

	/**
	 * Returns the value of taxes for all units.
	 *
	 * @return float
	 */
	public function countTaxValue(): float;

	/**
	 * Returns the value of unit without tax.
	 *
	 * @return float
	 */
	public function countUntaxedUnitValue(): float;

	/**
	 * Returns the final value of all taxed units.
	 *
	 * @return float
	 */
	public function countFinalValue(): float;
}
