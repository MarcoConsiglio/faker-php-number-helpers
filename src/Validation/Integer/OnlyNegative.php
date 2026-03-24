<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

class OnlyNegative extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        if ($min === PHP_INT_MIN) $min += 1;
        if ($this->isPositive($max)) $max = -1;
        if ($this->isPositive($min)) $min = PHP_INT_MIN + 1;
        $this->swap($min, $max);
    }
}