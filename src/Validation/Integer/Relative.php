<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;


/**
 * The relative `int` validator.
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