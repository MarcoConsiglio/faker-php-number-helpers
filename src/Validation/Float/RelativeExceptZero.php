<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class RelativeExceptZero extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $min = FloatRange::MIN;
        if ($this->isZero($min)) $min = FloatRange::MIN;
        if ($this->notAllowedFloat($max)) $max = FloatRange::MAX;
        if ($this->isZero($max)) $max = FloatRange::MAX;
        $this->swap($min, $max);
    }
}