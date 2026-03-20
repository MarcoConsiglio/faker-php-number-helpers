<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use Faker\Factory;
use Faker\Generator;
use Nsfisis\NextAfter\NextAfter;
use RoundingMode;

/**
 * FakerPHP support trait.
 */
trait WithFakerHelpers
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
    protected Generator $faker;

    /**
     * Set up the FakerPHP generator.
     * 
     * @codeCoverageIgnore
     */
    protected function setUpFaker(): void
    {
        if (! isset($this->faker))
            $this->faker = Factory::create(Factory::DEFAULT_LOCALE);
    }

    private function isZero(int|float $value): bool
    {
        return $value == 0;
    }

    /**
     * Return true if `$value` is positive, false otherwise.
     */
    private function isPositive(int|float $value): bool
    {
        return $value >= 0;
    }

    /**
     * Return true if `$value` is negative, false otherwise.
     */
    private function isNegative(int|float $value): bool
    {
        return $value < 0;
    }

    /**
     * Return true if both `$value_1` and `$value_2` are negative, false 
     * otherwise.
     */
    private function areBothNegative(int|float $value_1, int|float $value_2): bool
    {
        return $this->isNegative($value_1) && $this->isNegative($value_2);
    }

    /**
     * Return true if both `$value_1` and `$value_2` are positive, false 
     * otherwise.
     */
    private function areBothPositive(int|float $value_1, int|float $value_2): bool
    {
        return $this->isPositive($value_1) && $this->isPositive($value_2);
    }

    /**
     * Return a random relative integer.
     */
    protected function randomInteger(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): int
    {
        if ($this->areBothNegative($min, $max))
            return $this->negativeRandomInteger($min, $max);
        if ($this->areBothPositive($min, $max))
            return $this->positiveRandomInteger($min, $max);
        if ($this->faker->boolean)
            return $this->positiveRandomInteger(0, $max);
        else
            return $this->negativeRandomInteger($min, -1);
    }

    /**
     * Return a random positive integer.
     */
    protected function positiveRandomInteger(int $min = 0, int $max = PHP_INT_MAX): int
    {
        if ($this->isNegative($min)) $min = 0;
        if ($this->isNegative($max)) $max = $min + 1;
        return $this->faker->numberBetween($min, $max);
    }

    /**
     * Return a random negative integer.
     */
    protected function negativeRandomInteger(int $min = PHP_INT_MIN + 1, int $max = -1): int
    {
        $min = $this->limitNegativeInteger($min);
        $max = $this->limitNegativeInteger($max);
        if ($this->isPositive($min)) $min = -2;
        if ($this->isPositive($max)) $max = -1;
        return -$this->faker->numberBetween(abs($max), abs($min));
    }

    /**
     * Return a random positive integer except for zero.
     */
    protected function positiveNonZeroRandomInteger(int $min = 1, int $max = PHP_INT_MAX): int
    {
        if ($min < 1) $min = 1;
        return $this->positiveRandomInteger($min, $max);
    }

    /**
     * Return a random negative integer except for zero.
     */
    protected function negativeNonZeroRandomInteger(int $min = PHP_INT_MIN + 1, int $max = -1): int
    {
        return $this->negativeRandomInteger($min, $max);
    }

    /**
     * Return a random integer except for zero.
     */
    protected function nonZeroRandomInteger(int $min = PHP_INT_MIN + 1, int $max = PHP_INT_MAX): int
    {
        do {
            $number = $this->randomInteger($min, $max);
        } while ($this->isZero($number));
        return $number;
    }
    
    /**
     * Return a random relative float.
     */
    protected function randomFloat(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX, 
        int $precision = PHP_FLOAT_DIG
    ): float {
        if ($this->areBothNegative($min, $max))
            return $this->negativeRandomFloat($min, $max, $precision);
        if ($this->areBothPositive($min, $max))
            return $this->positiveRandomFloat($min, $max, $precision);
        if ($this->faker->boolean)
            return $this->positiveRandomFloat(0, $max, $precision);
        else
            return $this->negativeRandomFloat($min, 0 + NextAfter::nextDown(0), $precision);
    }

    /**
     * Return a positive random float.
     */
    protected function positiveRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, int $precision = PHP_FLOAT_DIG): float
    {
        $precision = $this->normalizePrecision($precision);
        if ($this->isNegative($min)) $min = 0;
        if ($this->isNegative($max)) $max = 1;
        return $this->faker->randomFloat($precision, $min, $max);
    }

    /**
     * Return a negative random float.
     */
    protected function negativeRandomFloat(float $min = -PHP_FLOAT_MAX, float $max = 0, int $precision = PHP_FLOAT_DIG): float
    {
        $precision = $this->normalizePrecision($precision);
        if ($this->isPositive($min)) $min = -1;
        if ($this->isPositive($max)) $max = 0 + NextAfter::nextDown(0);
        return -$this->faker->randomFloat($precision, abs($max), abs($min));
    }

    /**
     * Return a random relative float that is not an integer.
     */
    protected function randomFloatStrict(float $min = -self::STRICT_FLOAT_MAX, float $max = self::STRICT_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        if ($this->areBothNegative($min, $max))
            return $this->negativeRandomFloatStrict($min, $max, $precision);
        if ($this->areBothPositive($min, $max))
            return $this->positiveRandomFloatStrict($min, $max, $precision);
        if ($this->faker->boolean)
            return $this->positiveRandomFloatStrict(0, $max, $precision);
        else
            return $this->negativeRandomFloatStrict($min, precision: $precision);
    }

    /**
     * Return a positive random float that is not an integer.
     */
    protected function positiveRandomFloatStrict(float $min = 0, float $max = self::STRICT_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        $max = $this->limitPositiveStrictFloat($max);
        do {
            $number = $this->positiveRandomFloat($min, $max, $precision);
        } while ($number == round($number, 0, RoundingMode::HalfTowardsZero));
        return $number;
    }

    /**
     * Return a negative random float that is not an integer.
     */
    protected function negativeRandomFloatStrict(float $min = -self::STRICT_FLOAT_MAX, float $max = 0, $precision = PHP_FLOAT_DIG): float
    {
        $min = $this->limitNegativeStrictFloat($min);
        do {
            $number = $this->negativeRandomFloat($min, $max, $precision);
        } while ($number == round($number, 0, RoundingMode::HalfTowardsZero));
        return $number;
    }

    /**
     * Return a positve non zero random float.
     */
    protected function positiveNonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = $this->positiveRandomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    /**
     * Return a negative non zero random float.
     */
    protected function negativeNonZeroRandomFloat(float $min = 0, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = $this->negativeRandomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    /**
     * Return a random relative float except for zero.
     */
    protected function nonZeroRandomFloat(float $min = -PHP_FLOAT_MAX, float $max = PHP_FLOAT_MAX, $precision = PHP_FLOAT_DIG): float
    {
        do {
            $number = $this->randomFloat($min, $max, $precision);
        } while ($number == 0);
        return $number;
    }

    private function normalizePrecision(int $precision): int
    {
        $precision = abs($precision);
        if ($precision > PHP_FLOAT_DIG) $precision = PHP_FLOAT_DIG;
        return $precision;       
    }

    /**
     * Limit an integer `$value` to `PHP_INT_MIN + 1`;
     */
    private function limitNegativeInteger(int $value): int
    {
        if ($value == PHP_INT_MIN) return PHP_INT_MIN + 1;
        return $value;
    }

    /**
     * Limit the `$value` to the minimu number that can still have a fractional
     * part.
     */
    private function limitNegativeStrictFloat(float $value): float
    {
        if ($value < -self::STRICT_FLOAT_MAX) return self::STRICT_FLOAT_MAX;
        return $value;
    }

    /**
     * Limit the `$value` to the maximum number that can still have a fractional
     * part.
     */
    private function limitPositiveStrictFloat(float $value): float
    {
        if ($value > self::STRICT_FLOAT_MAX) return self::STRICT_FLOAT_MAX;
        return $value;
    }
}