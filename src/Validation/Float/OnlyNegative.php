<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyNegative extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MIN;
        if ($this->isPositive($min)) $min = FloatRange::MIN;
        if ($this->notAllowedFloat($max)) $max = -PHP_FLOAT_MIN;
        if ($this->isPositive($max)) $max = -PHP_FLOAT_MIN;
        $this->swap($min, $max);
    }
}