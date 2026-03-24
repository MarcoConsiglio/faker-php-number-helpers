<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class RelativeFractions extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MIN;
        if ($this->notAllowedFloat($max)) $max = FloatRange::MAX;
        if ($min === $max) {
            $min = FloatRange::MIN;
            $max = FloatRange::MAX;
        }
    }
}