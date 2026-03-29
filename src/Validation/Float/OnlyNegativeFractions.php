<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use Override;

/**
 * The negative `float` fractions range validator.
 */
class OnlyNegativeFractions extends Negative
{
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidPositiveFloats($min, $max);
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
}