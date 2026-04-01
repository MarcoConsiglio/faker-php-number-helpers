<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

/**
 * The positive non-null `int` validator.
 */
class OnlyPositiveExceptZero extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void
    {
        if ($this->lessThanOrEqual($min, 0)) $min = 1;
        if ($this->lessThanOrEqual($max, 0)) $max = IntRange::MAX;
    }
}