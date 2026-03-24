<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

class RelativeExceptZero extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        $this->avoidIntMin($min);
        $this->avoidIntMin($max);
        if ($this->isZero($min)) $min = -1;
        if ($this->isZero($max)) $max = 1;
    }
}