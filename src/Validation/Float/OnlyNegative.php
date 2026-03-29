<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * The negative `float` range validator.
 */
class OnlyNegative extends Negative
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void
    {
        $this->avoidNotAllowedFloats($min, $max);
        $this->avoidPositiveFloats($min, $max);
        $this->swap($min, $max);
    }
}