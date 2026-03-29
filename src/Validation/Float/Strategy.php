<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * A validation strategy.
 */
interface Strategy
{
    /**
     * Validate the range.
     */
    public function validate(float &$min, float &$max): void;
}