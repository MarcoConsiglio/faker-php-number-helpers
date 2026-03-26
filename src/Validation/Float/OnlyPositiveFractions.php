<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use Override;

class OnlyPositiveFractions extends Positive
{
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

    #[Override]
    protected function avoidNegativeFloats(float &$min, float &$max): void
    {
        if ($this->lessThanOrEqual($min, 0.0)) $this->setStandardMin($min);
        if ($this->lessThanOrEqual($max, 0.0)) $this->setStandardMax($max);
    }

    #[Override]
    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MICRO;
    }

    #[Override]
    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX_FRACTION;
    }
}