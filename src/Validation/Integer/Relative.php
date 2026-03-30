<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;

/**
 * The relative `float` validator.
 */
class Relative extends Validator
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void
    {
        $this->avoidIntMin($min);
        $this->avoidIntMin($max);
        $this->swap($min, $max);
    }
}