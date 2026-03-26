<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use Override;

class RelativeFractions extends Relative
{
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        if ($this->areBothEqual($min, $max)) {
            $this->setStandardMin($min);
            $this->setStandardMax($max);
        }
        $this->swap($min, $max);
    }

    #[Override]
    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN_FRACTION;
    }

    #[Override]
    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX_FRACTION;
    }
}