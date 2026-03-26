<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

class RelativeExceptZero extends Relative
{
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidZero($min, $max);
        $this->swap($min, $max);
    }

    protected function avoidZero(float &$min, float &$max): void
    {
        if ($this->isZero($min)) $this->setStandardMin($min);
        if ($this->isZero($max)) $this->setStandardMax($max);
    }
}