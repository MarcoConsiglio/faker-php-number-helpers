<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use Override;

/**
 * The relative `float` fractions range validator.
 */
class RelativeFractions extends Relative
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        if ($this->equal($min, $max)) {
            $this->setStandardMin($min);
            $this->setStandardMax($max);
        }
        $this->swap($min, $max);
    }

    /**
     * Set the standard lower extreme.
     */
    #[Override]
    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN_FRACTION;
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