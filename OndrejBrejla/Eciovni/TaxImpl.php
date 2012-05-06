<?php

namespace OndrejBrejla\Eciovni;

use Nette\Object;
use InvalidArgumentException;

/**
 * TaxImpl - part of Eciovni plugin for Nette Framework.
 *
 * @copyright  Copyright (c) 2009 Ondřej Brejla
 * @license    New BSD License
 * @link       http://github.com/OndrejBrejla/Eciovni
 */
class TaxImpl extends Object implements Tax {

    private $taxInUpperDecimal;

    private function __construct($upperDecimal) {
        $this->taxInUpperDecimal = $upperDecimal;
    }

    public static function fromPercent($percent) {
        if ($percent === NULL) {
            throw new InvalidArgumentException('$percent can not be null.');
        }
        return new TaxImpl(($percent * 0.01) + 1);
    }

    public static function fromDecimal($lowerDecimal) {
        if (!is_double($lowerDecimal)) {
            throw new InvalidArgumentException('$lowerDecimal must be a double, but ' . $lowerDecimal . ' given.');
        }
        return new TaxImpl($lowerDecimal + 1);
    }

    public static function fromUpperDecimal($upperDecimal) {
        if (!is_double($upperDecimal)) {
            throw new InvalidArgumentException('$upperDecimal must be a double, but ' . $upperDecimal . ' given.');
        }
        return new TaxImpl($upperDecimal);
    }

    public function inUpperDecimal() {
        return $this->taxInUpperDecimal;
    }

}