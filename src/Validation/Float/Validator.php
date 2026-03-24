<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator as AbstractValidator;

abstract class Validator extends AbstractValidator implements Strategy
{
    protected function swap(float &$min, float &$max): void
    {
        if ($min > $max) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }
    }

    protected function notAllowedFloat(float $value): bool
    {
        return is_infinite($value) || is_nan($value);
    }
}