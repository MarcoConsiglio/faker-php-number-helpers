<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

class OnlyPositive extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        if ($this->isNegative($min)) $min = 0;
        if ($this->isNegative($max)) $max = IntRange::MAX;
        $this->swap($min, $max);
    }
}