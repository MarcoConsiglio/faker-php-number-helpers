<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * The relative non-null `float` range validator.
 */
class RelativeExceptZero extends Relative
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidZero($min, $max);
        $this->swap($min, $max);
    }

    /**
     * Avoid null extremes of the range.
     */
    protected function avoidZero(float &$min, float &$max): void
    {
        if ($this->isZero($min)) $this->setStandardMin($min);
        if ($this->isZero($max)) $this->setStandardMax($max);
    }
}