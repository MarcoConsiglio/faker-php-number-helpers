<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

/**
 * A positive `float` range validator.
 */
abstract class Positive extends Validator
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
     * Avoid the negative extremes of the range.
     */
    protected function avoidNegativeFloats(float &$min, float &$max): void
    {
        if ($this->isNegative($min)) $this->setStandardMin($min);
        if ($this->isNegative($max)) $this->setStandardMax($max);
    }

    /**
     * Set the standard lower extreme.
     */
    protected function setStandardMin(float &$min): void
    {
        $min = 0.0;
    }

    /**
     * Set the standard higher extreme.
     */
    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX;
    }
}