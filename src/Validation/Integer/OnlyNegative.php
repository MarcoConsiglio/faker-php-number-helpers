<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

/**
 * The negative `float` validator.
 */
class OnlyNegative extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void
    {
        $this->avoidIntMin($min);
        $this->avoidIntMin($max);
        if ($this->isPositive($min)) $min = IntRange::MIN;
        if ($this->isPositive($max)) $max = -1;
        $this->swap($min, $max);
    }
}