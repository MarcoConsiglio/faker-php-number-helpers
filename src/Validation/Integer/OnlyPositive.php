<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
/**
 * The positive `int` validator.
 */
class OnlyPositive extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void
    {
        if ($this->isNegative($min)) $min = 0;
        if ($this->isNegative($max)) $max = IntRange::MAX;
        $this->swap($min, $max);
    }
}