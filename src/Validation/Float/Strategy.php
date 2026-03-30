<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * A `float` validation strategy.
 */
interface Strategy
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void;
}