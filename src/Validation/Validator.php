<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation;

use RoundingMode;

abstract class Validator
{
    /**
     * Return `true` if `$value` is zero.
     */
    public static function isZero(int|float $value): bool
    {
        return $value == 0;
    }

    /**
     * Return `true` if `$value` is positive, `false` otherwise.
     */
    public static function isPositive(int|float $value): bool
    {
        return $value >= 0;
    }

    /**
     * Return `true` if `$value` is negative, `false` otherwise.
     */
    public static function isNegative(int|float $value): bool
    {
        return $value < 0;
    }

    /**
     * Return `true` if `$value` has no fractional part, `false` otherwise.
     */
    public static function hasNoFraction(float $value): bool
    {
        return round($value, 0, RoundingMode::HalfTowardsZero) === $value;
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are negative, `false` 
     * otherwise.
     */
    public static function areBothNegative(int|float $value_1, int|float $value_2): bool
    {
        return self::isNegative($value_1) && self::isNegative($value_2);
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are positive, `false` 
     * otherwise.
     */
    public static function areBothPositive(int|float $value_1, int|float $value_2): bool
    {
        return self::isPositive($value_1) && self::isPositive($value_2);
    }

    /**
     * Return `true` if both `$value_1` and `$value_2` are equal, `false` 
     * otherwise.
     */
    protected function areBothEqual(float $value_1, float $value_2): bool
    {
        return $value_1 === $value_2;     
    }

    /**
     * Return `true` if `$value_1` is less than or equal to `$value_2`, 
     * `false` otherwise.
     */
    public static function lessThanOrEqual(int|float $value_1, int|float $value_2): bool
    {
        return $value_1 <= $value_2;
    }
}