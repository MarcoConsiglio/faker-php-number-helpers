<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

/**
 * A random `float` number generator.
 */
abstract class Generator extends RandomGenerator
{
    /**
     * Contruct the `Generator`.
     */
    public function __construct(
        FakerGenerator $generator,
        Validator $validator, 
        protected FloatRange $range
    ) {
        parent::__construct($generator, $validator);
    }

    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    abstract public function generate(int $precision): float;

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