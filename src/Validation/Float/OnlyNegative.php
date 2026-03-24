<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyNegative extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MIN;
        if ($this->isPositive($min)) $min = FloatRange::MIN;
        if ($this->notAllowedFloat($max)) $max = -FloatRange::MICRO;
        if ($this->isPositive($max)) $max = -FloatRange::MICRO;
        $this->swap($min, $max);
    }
}