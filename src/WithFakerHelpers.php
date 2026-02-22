<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use Faker\Factory;
use Faker\Generator;

/**
 * FakerPHP support trait.
 */
trait WithFakerHelpers
{
    /**
     * The FakerPHP random generator.
     */
    protected static Generator $faker;

    /**
     * Set up the FakerPHP generator.
     */
    protected static function setUpFaker(): void
    {
        if (! isset(self::$faker))
            self::$faker = Factory::create(Factory::DEFAULT_LOCALE);
    }

    /**
     * Return a random relative integer.
     */
    protected static function randomInteger(int $min = 0, int $max = PHP_INT_MAX): int
    {
        $value = self::positiveRandomInteger($min, $max);
        return self::$faker->randomElement([$value, -$value]);
    }

    /**
     * Return a random positive integer.
     */
    protected static function positiveRandomInteger(int $min = 0, int $max = PHP_INT_MAX): int
    {
        [$min, $max] = self::validateIntegerRange($min, $max);
        return self::$faker->numberBetween($min, $max);
    }

    /**
     * Return a random negative integer.
     */
    protected static function negativeRandomInteger(int $min = 1, int $max = PHP_INT_MAX): int
    {
        if ($min < 1) $min = 1;
        return -self::positiveRandomInteger($min, $max);
    }

    /**
     * Return a random positive integer except for zero.
     */
    protected static function positiveNonZeroRandomInteger(int $min = 1, int $max = PHP_INT_MAX): int
    {
        if ($min < 1) $min = 1;
        return self::positiveRandomInteger($min, $max);
    }

    /**
     * Return a random negative integer except for zero.
     */
    protected static function negativeNonZeroRandomInteger(int $min = 1, int $max = PHP_INT_MAX): int
    {
        return self::negativeRandomInteger($min, $max);
    }

    /**
     * Return a random integer except for zero.
     */
    protected static function nonZeroRandomInteger(int $min = 0, int $max = PHP_INT_MAX): int
    {
        do {
            $number = self::randomInteger($min, $max);
        } while ($number == 0);
        return $number;
    }

    /**
     * Validate integer range.
     * 
     * @codeCoverageIgnore
     */
    private static function validateIntegerRange(int $min, int $max): array
    {
        if ($min < 0) $min = abs($min);
        if ($min > PHP_INT_MAX) $min = PHP_INT_MAX;
        if ($max < 0) $max = abs($max);
        if ($max > PHP_INT_MAX) $max = PHP_INT_MAX;
        $true_min = min($min, $max);
        $true_max = max($min, $max);
        return [$true_min, $true_max];
    }
    
    /**
     * Return a random relative float.
     */
    protected static function randomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        $value = self::positiveRandomFloat($min, $max, $precision);
        return self::$faker->randomElement([$value, -$value]);
    }

    /**
     * Return a random relative float that is not an integer.
     * 
     * @param float $max Warning! Using this method with a big number in $max parameter result
     * in endless cycle.
     */
    protected static function randomFloatStrict(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        $value = self::positiveRandomFloatStrict($min, $max, $precision);
        return self::$faker->randomElement([
            $value, -$value
        ]);
    }

    /**
     * Return a positive random float that is not an integer.
     */
    protected static function positiveRandomFloatStrict(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        if ($precision < 1) $precision = 1;
        do {
            $number = self::positiveRandomFloat($min, $max, $precision);
        } while ($number == intval($number));
        return $number;
    }

    /**
     * Return a negative random float that is not an integer.
     */
    protected static function negativeRandomFloatStrict(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return -self::positiveRandomFloatStrict($min, $max, $precision);
    }

    /**
     * Return a positive random float.
     */
    protected static function positiveRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        [$min, $max, $precision] = self::validateFloatRange($min, $max, $precision);
        return self::$faker->randomFloat($precision, $min, $max);
    }

    /**
     * Return a positve non zero random float.
     */
    protected static function positiveNonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = self::positiveRandomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    /**
     * Return a negative random float.
     */
    protected static function negativeRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        return -self::positiveRandomFloat($min, $max, $precision);
    }

    /**
     * Return a negative non zero random float.
     */
    protected static function negativeNonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = self::negativeRandomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    /**
     * Return a random relative float except for zero.
     */
    protected static function nonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = self::randomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    /**
     * Validate float range.
     * 
     * @codeCoverageIgnore
     */
    private static function validateFloatRange(float $min, float $max, int $precision): array
    {
        if ($min < 0) $min = abs($min);
        if ($min > PHP_FLOAT_MAX) $min = PHP_FLOAT_MAX; 
        if ($max < 0) $max = abs($max);
        if ($max > PHP_FLOAT_MAX) $max = PHP_FLOAT_MAX;
        if ($precision < 0) $precision = abs($precision);
        if ($precision > PHP_FLOAT_DIG) $precision = PHP_FLOAT_DIG;
        $true_min = min($min, $max);
        $true_max = max($min, $max);
        return [$true_min, $true_max, $precision];
    }
}