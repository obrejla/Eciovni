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

    /** @var double */
    private $taxInUpperDecimal;

    /**
     * Creates new TaxImpl object.
     *
     * @param double $upperDecimal
     */
    private function __construct($upperDecimal) {
        $this->taxInUpperDecimal = $upperDecimal;
    }

    /**
     * Creates new Tax from a percent value.
     *
     * @param int|double $percent
     * @return Tax
     * @throws InvalidArgumentException
     */
    public static function fromPercent($percent) {
        if ($percent === NULL) {
            throw new InvalidArgumentException('$percent can not be null.');
        }
        return new TaxImpl(($percent * 0.01) + 1);
    }

    /**
     * Creates new Tax from a lower decimal value.
     * I.e. value must be '0.22' for a tax of '22%'.
     *
     * @param double $lowerDecimal
     * @return Tax
     * @throws InvalidArgumentException
     */
    public static function fromLowerDecimal($lowerDecimal) {
        if (!is_double($lowerDecimal)) {
            throw new InvalidArgumentException('$lowerDecimal must be a double, but ' . $lowerDecimal . ' given.');
        }
        return new TaxImpl($lowerDecimal + 1);
    }

    /**
     * Creates new Tax from a upper decimal value.
     * I.e. value must be '1.22' for a tax of '22%'.
     *
     * @param double $lowerDecimal
     * @return Tax
     * @throws InvalidArgumentException
     */
    public static function fromUpperDecimal($upperDecimal) {
        if (!is_double($upperDecimal)) {
            throw new InvalidArgumentException('$upperDecimal must be a double, but ' . $upperDecimal . ' given.');
        }
        return new TaxImpl($upperDecimal);
    }

    /**
     * Returns tax in a upper decimal format.
     * I.e. '1.22' for '22%'.
     *
     * @return double
     */
    public function inUpperDecimal() {
        return $this->taxInUpperDecimal;
    }

}