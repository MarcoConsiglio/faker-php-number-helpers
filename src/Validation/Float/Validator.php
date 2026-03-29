<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator as AbstractValidator;

/**
 * A random `float` range validator.
 */
abstract class Validator extends AbstractValidator implements Strategy
{
    /**
     * Swap the extremes if they are reversed.
     */
    protected function swap(float &$min, float &$max): void
    {
        if ($min > $max) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }
    }

    /**
     * Return `true` if `$value` is infinity or not a number, `false` 
     * otherwise.
     */
    protected function notAllowedFloat(float $value): bool
    {
        return is_infinite($value) || is_nan($value);
    }
}