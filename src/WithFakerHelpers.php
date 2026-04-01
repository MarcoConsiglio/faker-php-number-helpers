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
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative as OnlyNegativeFloats;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive as OnlyPositiveFloats;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero as OnlyPositiveFloatsExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeFloats;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeExceptZero as RelativeFloatsExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative as OnlyNegativeIntegers;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive as OnlyPositiveIntegers;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero as OnlyPositiveIntegersExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Relative as RelativeIntegers;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\RelativeExceptZero as RelativeIntegersExceptZero;

/**
 * FakerPHP support trait that provides helper functions to easily generate 
 * random numbers.
 */
trait WithFakerHelpers
{
    /**
     * The FakerPHP random generator.
     */
    protected static Generator $faker;

    /**
     * Set up the FakerPHP generator.
     * 
     * @codeCoverageIgnore
     */
    protected static function setUpFaker(string $locale = Factory::DEFAULT_LOCALE): void
    {
        if (! isset(self::$faker))
            self::$faker = Factory::create($locale);
    }

    /**
     * Return a random relative integer.
     */
    protected static function randomInteger(int $min = IntRange::MIN, int $max = IntRange::MAX): int
    {
        return new RelativeInteger(
            self::$faker,
            new RelativeIntegers,
            new IntRange($min, $max)
        )->generate();
    }

    /**
     * Return a positive random integer.
     */
    protected static function positiveRandomInteger(int $min = 0, int $max = IntRange::MAX): int
    {
        return new PositiveInteger(
            self::$faker,
            new OnlyPositiveIntegers,
            new IntRange($min, $max)
        )->generate();
    }

    /**
     * Return a negative random integer.
     */
    protected static function negativeRandomInteger(int $min = IntRange::MIN, int $max = -1): int
    {
        return new NegativeInteger(
            self::$faker,
            new OnlyNegativeIntegers,
            new IntRange($min, $max)
        )->generate();
    }

    /**
     * Return a positive random integer except for zero.
     */
    protected static function positiveNonZeroRandomInteger(int $min = 1, int $max = IntRange::MAX): int
    {
        return new PositiveIntegerExceptZero(
            self::$faker,
            new OnlyPositiveIntegersExceptZero,
            new IntRange($min, $max)
        )->generate();
    }

    /**
     * Return a negative random integer except for zero.
     */
    protected static function negativeNonZeroRandomInteger(int $min = IntRange::MIN, int $max = -1): int
    {
        return self::negativeRandomInteger($min, $max);
    }

    /**
     * Return a random integer except for zero.
     */
    protected static function nonZeroRandomInteger(int $min = IntRange::MIN, int $max = IntRange::MAX): int
    {
        return new RelativeIntegerExceptZero(
            self::$faker,
            new RelativeIntegersExceptZero,
            new IntRange($min, $max)
        )->generate();
    }
    
    /**
     * Return a random relative float.
     */
    protected static function randomFloat(
        float $min = FloatRange::MIN, 
        float $max = FloatRange::MAX, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new RelativeFloat(
            self::$faker,
            new RelativeFloats,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a positive random float.
     */
    protected static function positiveRandomFloat(
        float $min = 0, 
        float $max = FloatRange::MAX, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new PositiveFloat(
            self::$faker,
            new OnlyPositiveFloats,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a negative random float.
     */
    protected static function negativeRandomFloat(
        float $min = FloatRange::MIN, 
        float $max = 0, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new NegativeFloat(
            self::$faker,
            new OnlyNegativeFloats,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a random relative float that is not a `float` type integer.
     */
    protected static function randomFraction(
        float $min = -FloatRange::MAX_FRACTION, 
        float $max = FloatRange::MAX_FRACTION, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new RelativeFraction(
            self::$faker,
            new RelativeFractions,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a positive random float that is not an integer.
     */
    protected static function positiveRandomFraction(
        float $min = 0, 
        float $max = FloatRange::MAX_FRACTION, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new PositiveFraction(
            self::$faker,
            new OnlyPositiveFractions,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a negative random float that is not an integer.
     */
    protected static function negativeRandomFraction(
        float $min = -FloatRange::MAX_FRACTION, 
        float $max = 0, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new NegativeFraction(
            self::$faker,
            new OnlyNegativeFractions,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a positve non zero random float.
     */
    protected static function positiveNonZeroRandomFloat(
        float $min = 0, 
        float $max = FloatRange::MAX, 
        int $precision = PHP_FLOAT_DIG): float
    {
        return new PositiveExceptZero(
            self::$faker,
            new OnlyPositiveFloatsExceptZero,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a negative non zero random float.
     */
    protected static function negativeNonZeroRandomFloat(
        float $min = FloatRange::MIN, 
        float $max = 0, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new NegativeExceptZero(
            self::$faker,
            new OnlyNegativeFloats,
            new FloatRange($min, $max)
        )->generate($precision);
    }

    /**
     * Return a random relative float except for zero.
     */
    protected static function nonZeroRandomFloat(
        float $min = FloatRange::MIN, 
        float $max = FloatRange::MAX, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        return new RelativeExceptZero(
            self::$faker,
            new RelativeFloatsExceptZero,
            new FloatRange($min, $max)
        )->generate($precision);
    }
}