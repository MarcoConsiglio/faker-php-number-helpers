<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use Override;

/**
 * The negative `float` range validator.
 */
class OnlyPositiveFractions extends Positive
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidNegativeFloats($min, $max);
        if ($this->areBothEqual($min, $max)) {
            $this->setStandardMin($min);
            $this->setStandardMax($max);
        }
        $this->swap($min, $max);
    }

    /**
     * Avoid the negative extremes of the range.
     */
    #[Override]
    protected function avoidNegativeFloats(float &$min, float &$max): void
    {
        if ($this->lessThanOrEqual($min, 0.0)) $this->setStandardMin($min);
        if ($this->lessThanOrEqual($max, 0.0)) $this->setStandardMax($max);
    }

    /**
     * Set the standard lower extreme.
     */
    #[Override]
    protected function setStandardMin(float &$min): void
    {
        $min = NextFloat::afterZero();
    }

    /**
     * Set the standard higher extreme.
     */
    #[Override]
    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX_FRACTION;
    }
}