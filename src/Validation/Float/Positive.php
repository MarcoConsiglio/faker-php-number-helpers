<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

/**
 * A positive `float` range validator.
 */
abstract class Positive extends Validator
{
    protected function avoidNotAllowedFloats(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $this->setStandardMin($min);
        if ($this->notAllowedFloat($max)) $this->setStandardMax($max);
    }

    protected function avoidNegativeFloats(float &$min, float &$max): void
    {
        if ($this->isNegative($min)) $this->setStandardMin($min);
        if ($this->isNegative($max)) $this->setStandardMax($max);
    }

    protected function setStandardMin(float &$min): void
    {
        $min = 0.0;
    }

    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX;
    }
}