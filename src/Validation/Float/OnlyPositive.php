<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyPositive extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->isNegative($min)) $min = 0.0;
        if ($this->isNegative($max)) $max = FloatRange::MAX;
        $this->swap($min, $max);
    }
}