<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class OnlyPositive extends Positive
{
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidNegativeFloats($min, $max);
        $this->swap($min, $max);
    }
}