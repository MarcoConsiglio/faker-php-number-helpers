<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

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

    protected function areBothEqual(float $value_1, float $value_2): bool
    {
        return $value_1 === $value_2;     
    }

    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN_FRACTION;
    }
}