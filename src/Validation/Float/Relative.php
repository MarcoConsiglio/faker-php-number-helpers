<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;

class Relative extends Validator
{
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->swap($min, $max);
    }

    protected function avoidNotAllowedFloats(float &$min, float &$max): void
    {
        if ($this->notAllowedFloat($min)) $this->setStandardMin($min);
        if ($this->notAllowedFloat($max)) $this->setStandardMax($max);
    }

    protected function setStandardMin(float &$min): void
    {
        $min = FloatRange::MIN;
    }

    protected function setStandardMax(float &$max): void
    {
        $max = FloatRange::MAX;
    }
}