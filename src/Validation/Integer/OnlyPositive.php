<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

class OnlyPositive extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        if ($this->isNegative($min)) $min = 0;
        if ($this->isNegative($max)) $max = PHP_INT_MAX;
        $this->swap($min, $max);
    }
}