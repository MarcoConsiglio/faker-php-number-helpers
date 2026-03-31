<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use Nsfisis\NextAfter\NextAfter;

/**
 * Calculate the adjacent `float` value.
 */
class NextFloat
{
    /**
     * Return the adjacent `float` number after `$value`.
     */
    static function after(float $value): float
    {
        if ($value === 0.0) return PHP_FLOAT_MIN;
        return NextAfter::nextUp($value);
    }

    /**
     * Return the adjacent `float` number before `$value`.
     */
    static function before(float $value): float
    {
        if ($value === 0.0) return -PHP_FLOAT_MIN;  
        return NextAfter::nextDown($value);
    }

    /**
     * Return the adjacent `float` number after zero.
     */
    static function afterZero(): float
    {
        return PHP_FLOAT_MIN;
    }

    /**
     * Return the adjacent `float` number before zero.
     */
    static function beforeZero(): float
    {
        return -PHP_FLOAT_MIN;
    }
}