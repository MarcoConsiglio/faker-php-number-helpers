<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator as AbstractValidator;

abstract class Validator extends AbstractValidator implements Strategy
{
    protected function swap(int &$min, int &$max): void
    {
        if ($min > $max) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }
    }

    protected function avoidIntMin(int &$value): void
    {
        if ($value === PHP_INT_MIN) $value = IntRange::MIN;
    }
}