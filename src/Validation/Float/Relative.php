<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

/**
 * The relative `float` range validator.
 */
class Relative extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->swap($min, $max);
    }

    /**
     * Avoid infinity and not a number values.
     */
    protected function avoidNotAllowedFloats(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $this->setStandardMin($min);
        if ($this->notAllowedFloat($max)) $this->setStandardMax($max);
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
        $max = FloatRange::MAX;
    }
}