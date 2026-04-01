<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation;

use RoundingMode;

/**
 * A random range `Validator`.
 */
abstract class Validator
{
    /**
     * Return `true` if `$value` is zero.
     */
    protected function isZero(int|float $value): bool
    {
        return $value == 0;
    }

    /**
     * Return `true` if `$value` is positive, `false` otherwise.
     */
    protected function isPositive(int|float $value): bool
    {
        return $value >= 0;
    }

    /**
     * Return `true` if `$value` is negative, `false` otherwise.
     */
    public function isNegative(int|float $value): bool
    {
        return $value < 0;
    }

    /**
     * Return `true` if `$value` has no fractional part, `false` otherwise.
     */
    public function hasNoFraction(float $value): bool
    {
        return round($value, 0, RoundingMode::HalfTowardsZero) === $value;
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are negative, `false` 
     * otherwise.
     */
    public function areBothNegative(int|float $value_1, int|float $value_2): bool
    {
        return $this->isNegative($value_1) && $this->isNegative($value_2);
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are positive, `false` 
     * otherwise.
     */
    public function areBothPositive(int|float $value_1, int|float $value_2): bool
    {
        return $this->isPositive($value_1) && $this->isPositive($value_2);
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are equal, `false` 
     * otherwise.
     */
    protected function equal(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 == $value_2;     
    }

    /**
     * Return `true` if `$value_1` is different than `$value_2`, `false` otherwise.
     */
    protected function different(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 != $value_2;
    }

    /**
     * Return `true` if `$value_1` is greater than or equal to `$value_2`, `false` 
     * otherwise.
     */
    protected function greaterThanOrEqual(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 >= $value_2;
    }

    /**
     * Return `true` if `$value_1` is greater than `$value_2`, `false` otherwise.
     */
    protected function greaterThan(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 > $value_2;
    }

    /**
     * Return `true` if `$value_1` is less than or equal to `$value_2`, 
     * `false` otherwise.
     */
    protected function lessThanOrEqual(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 <= $value_2;
    }

    /**
     * Return `true` if `$value_1` is less than `$value_2`, `false` otherwise.
     */
    protected function lessThan(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 < $value_2;
    }
}