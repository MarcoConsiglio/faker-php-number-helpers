<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;

/**
 * A negative `float` range validator.
 */
abstract class Negative extends Validator
{
    /**
     * Avoid infinity and not a number values.
     */
    protected function avoidNotAllowedFloats(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $this->setStandardMin($min);
        if ($this->notAllowedFloat($max)) $this->setStandardMax($max);
    }

    /**
     * Avoid the positive extremes of the range.
     */
    protected function avoidPositiveFloats(float &$min, float &$max): void
    {
        if ($this->isPositive($min)) $this->setStandardMin($min);
        if ($this->isPositive($max)) $this->setStandardMax($max);
    }

    /**
     * Set the standard lower extreme.
     */
    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN;
    }

    /**
     * Set the standard higher extreme.
     */
    protected function setStandardMax(float &$max): void
    {
        $max = NextFloat::beforeZero();
    }
}