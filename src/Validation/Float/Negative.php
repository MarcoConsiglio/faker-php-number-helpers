<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

/**
 * A negative `float` range validator.
 */
abstract class Negative extends Validator
{
    protected function avoidNotAllowedFloats(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $this->setStandardMin($min);
        if ($this->notAllowedFloat($max)) $this->setStandardMax($max);
    }

    protected function avoidPositiveFloats(float &$min, float &$max): void
    {
        if ($this->isPositive($min)) $this->setStandardMin($min);
        if ($this->isPositive($max)) $this->setStandardMax($max);
    }

    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN;
    }

    protected function setStandardMax(float &$max): void
    {
        $max = -FloatRange::MICRO;
    }
}