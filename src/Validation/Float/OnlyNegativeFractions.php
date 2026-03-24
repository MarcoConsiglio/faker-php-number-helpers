<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyNegativeFractions extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MIN;
        if ($this->isPositive($min)) $min = FloatRange::MAX_FRACTION;
        if ($this->notAllowedFloat($max)) $max = -FloatRange::MICRO;
        if ($this->isPositive($max)) $max = -FloatRange::MAX_FRACTION;
        if ($min === $max) {
            $min = FloatRange::MAX_FRACTION;
            $max = -FloatRange::MICRO;
        }
    }
}