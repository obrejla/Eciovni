<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


/**
 * Tax - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       https://github.com/obrejla/Eciovni
 */
interface Tax
{
	/**
	 * Returns tax in a upper decimal format.
	 * I.e. '1.22' for '22%'.
	 */
	public function inUpperDecimal(): float;
}
