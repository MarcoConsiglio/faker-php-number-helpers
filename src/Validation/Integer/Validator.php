<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

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
}