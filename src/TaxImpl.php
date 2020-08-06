<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


use Nette\SmartObject;

/**
 * TaxImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       https://github.com/obrejla/Eciovni
 */
class TaxImpl implements Tax
{
	use SmartObject;

	/** @var float */
	private $taxInUpperDecimal;


	private function __construct(float $upperDecimal)
	{
		$this->taxInUpperDecimal = $upperDecimal;
	}


	/**
	 * Creates new Tax from a percent value.
	 */
	public static function fromPercent(float $percent): Tax
	{
		return new self(($percent * 0.01) + 1);
	}


	/**
	 * Creates new Tax from a lower decimal value.
	 * I.e. value must be '0.22' for a tax of '22%'.
	 */
	public static function fromLowerDecimal(float $lowerDecimal): self
	{
		return new self($lowerDecimal + 1);
	}


	/**
	 * Creates new Tax from a upper decimal value.
	 * I.e. value must be '1.22' for a tax of '22%'.
	 */
	public static function fromUpperDecimal(float $upperDecimal): self
	{
		return new self($upperDecimal);
	}


	/**
	 * Returns tax in a upper decimal format.
	 * I.e. '1.22' for '22%'.
	 */
	public function inUpperDecimal(): float
	{
		return $this->taxInUpperDecimal;
	}
}
