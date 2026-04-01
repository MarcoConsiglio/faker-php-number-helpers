<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

/**
 * The relative non-null `int` validator.
 */
class RelativeExceptZero extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void
    {
        $this->avoidIntMin($min);
        $this->avoidIntMin($max);
        if ($this->isZero($min)) $min = -1;
        if ($this->isZero($max)) $max = 1;
    }
}