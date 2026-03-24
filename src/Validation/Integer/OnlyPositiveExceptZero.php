<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

class OnlyPositiveExceptZero extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        if ($this->isNegative($min) || $this->isZero($min)) $min = 1;
        if ($this->isNegative($max) || $this->isZero($min)) $max = IntRange::MAX;
    }
}