<?php

declare(strict_types=1);

namespace OndrejBrejla\Eciovni;


interface Tax
{
	/**
	 * Returns tax in a upper decimal format.
	 * I.e. '1.22' for '22%'.
	 */
	public function inUpperDecimal(): float;
}
