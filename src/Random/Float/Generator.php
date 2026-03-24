<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use Faker\Generator as FakerGenerator;

abstract class Generator extends RandomGenerator
{
    public function __construct(
        protected FakerGenerator &$generator, 
        protected FloatRange $range
    ) {}

    abstract public function generate(int $precision): float;

    abstract protected function validate(): void;

    /**
     * Limit the `$precision` between `0` and `PHP_FLOAT_DIG`.
     */
    protected function normalizePrecision(int $precision): int
    {
        $precision = abs($precision);
        if ($precision > PHP_FLOAT_DIG) $precision = PHP_FLOAT_DIG;
        return $precision;       
    }
}