<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyPositiveExceptZero extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MICRO;
        if ($this->isNegative($min)) $min = FloatRange::MICRO;
        if ($this->isZero($min)) $min = FloatRange::MICRO;
        if ($this->notAllowedFloat($max)) $max = FloatRange::MAX;
        if ($this->isNegative($max)) $max = FloatRange::MAX;
        if ($this->isZero($max)) $max = FloatRange::MAX;
    }
}