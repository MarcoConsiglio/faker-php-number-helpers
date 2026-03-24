<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use Faker\Factory;
use Faker\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative as NegativeFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive as PositiveFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative as RelativeFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Negative as NegativeInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Positive as PositiveInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\PositiveExceptZero as PositiveIntegerExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Relative as RelativeInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\RelativeExceptZero as RelativeIntegerExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions;
use Nsfisis\NextAfter\NextAfter;
use RoundingMode;

/**
 * FakerPHP support trait that provides helper functions to easily generate 
 * random numbers inside PHPUnit data providers.
 */
trait WithStaticFakerHelpers
{
    /**
     * The maximum `float` value that can still have a fractional part. This 
     * value is based on a 64 bit `float`.
     * 
     * @see https://float.exposed/0x432ffffffffffffe
     */
    public const float STRICT_FLOAT_MAX = 4503599627370495;

    /**
     * The FakerPHP random generator.
     */
    protected static Generator $faker;

    /**
     * Set up the FakerPHP generator.
     * 
     * @codeCoverageIgnore
     */
    protected static function setUpFaker(): void
    {
        if (! isset(self::$faker))
            self::$faker = Factory::create(Factory::DEFAULT_LOCALE);
    }

    /**
     * Return true if `$value` is zero.
     */
    private static function isZero(int|float $value): bool
    {
        return $value == 0;
    }

    /**
     * Return true if `$value` is positive, false otherwise.
     */
    private static function isPositive(int|float $value): bool
    {
        return $value >= 0;
    }

    /**
     * Return true if `$value` is negative, false otherwise.
     */
    private static function isNegative(int|float $value): bool
    {
        return $value < 0;
    }

    /**
     * Return true if both `$value_1` and `$value_2` are negative, false 
     * otherwise.
     */
    private static function areBothNegative(int|float $value_1, int|float $value_2): bool
    {
        return self::isNegative($value_1) && self::isNegative($value_2);
    }

    /**
     * Return true if both `$value_1` and `$value_2` are positive, false 
     * otherwise.
     */
    private static function areBothPositive(int|float $value_1, int|float $value_2): bool
    {
        return self::isPositive($value_1) && self::isPositive($value_2);
    }

    /**
     * Return a random relative integer.
     */
    protected static function randomInteger(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): int
    {
        return new RelativeInteger(self::$faker, new IntRange($min, $max))->generate();
    }

    /**
     * Return a positive random integer.
     */
    protected static function positiveRandomInteger(int $min = 0, int $max = PHP_INT_MAX): int
    {
        return new PositiveInteger(self::$faker, new IntRange($min, $max))->generate();
    }

    /**
     * Return a negative random integer.
     */
    protected static function negativeRandomInteger(int $min = PHP_INT_MIN + 1, int $max = -1): int
    {
        return new NegativeInteger(self::$faker, new IntRange($min, $max))->generate();
    }

    /**
     * Return a positive random integer except for zero.
     */
    protected static function positiveNonZeroRandomInteger(int $min = 1, int $max = PHP_INT_MAX): int
    {
        return new PositiveIntegerExceptZero(self::$faker, new IntRange($min, $max))->generate();
    }

    /**
     * Return a negative random integer except for zero.
     */
    protected static function negativeNonZeroRandomInteger(int $min = PHP_INT_MIN + 1, int $max = -1): int
    {
        return self::negativeRandomInteger($min, $max);
    }

    /**
     * Return a random integer except for zero.
     */
    protected static function nonZeroRandomInteger(int $min = PHP_INT_MIN + 1, int $max = PHP_INT_MAX): int
    {
        return new RelativeIntegerExceptZero(self::$faker, new IntRange($min, $max))->generate();
    }
    
    /**
     * Return a random relative float.
     */
    protected static function randomFloat(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new RelativeFloat(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a positive random float.
     */
    protected static function positiveRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, int $precision = PHP_FLOAT_DIG): float
    {
        return new PositiveFloat(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a negative random float.
     */
    protected static function negativeRandomFloat(float $min = -PHP_FLOAT_MAX, float $max = 0, int $precision = PHP_FLOAT_DIG): float
    {
        return new NegativeFloat(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a random relative float that is not a `float` type integer.
     */
    protected static function randomFraction(float $min = -self::STRICT_FLOAT_MAX, float $max = self::STRICT_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return new RelativeFraction(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a positive random float that is not an integer.
     */
    protected static function positiveRandomFraction(float $min = 0, float $max = self::STRICT_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return new PositiveFraction(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a negative random float that is not an integer.
     */
    protected static function negativeRandomFraction(float $min = -self::STRICT_FLOAT_MAX, float $max = 0, $precision = PHP_FLOAT_DIG): float
    {
        return new NegativeFraction(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a positve non zero random float.
     */
    protected static function positiveNonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return new PositiveExceptZero(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a negative non zero random float.
     */
    protected static function negativeNonZeroRandomFloat(float $min = -PHP_FLOAT_MAX, float $max = 0, $precision = PHP_FLOAT_DIG): float
    {
        return new NegativeExceptZero(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Return a random relative float except for zero.
     */
    protected static function nonZeroRandomFloat(float $min = -PHP_FLOAT_MAX, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return new RelativeExceptZero(self::$faker, new FloatRange($min, $max))->generate($precision);
    }

    /**
     * Limit the `$precision` between `0` and `PHP_FLOAT_DIG`.
     */
    private static function normalizePrecision(int $precision): int
    {
        $precision = abs($precision);
        if ($precision > PHP_FLOAT_DIG) $precision = PHP_FLOAT_DIG;
        return $precision;       
    }

    /**
     * If `$value` is negative limit to `PHP_INT_MIN + 1`.
     */
    private static function limitNegativeInteger(int $value): int
    {
        if ($value === PHP_INT_MIN) return PHP_INT_MIN + 1;
        return $value;
    }

    /**
     * Limit the `$value` to the minimum number that can still have a fractional
     * part.
     */
    private static function limitNegativeStrictFloat(float $value): float
    {
        if ($value < -self::STRICT_FLOAT_MAX) return self::STRICT_FLOAT_MAX;
        return $value;
    }

    /**
     * Limit the `$value` to the maximum number that can still have a fractional
     * part.
     */
    private static function limitPositiveStrictFloat(float $value): float
    {
        if ($value > self::STRICT_FLOAT_MAX) return self::STRICT_FLOAT_MAX;
        return $value;
    }
}