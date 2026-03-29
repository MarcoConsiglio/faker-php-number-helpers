<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * A validation strategy.
 */
interface Strategy
{
    public function validate(float &$min, float &$max): void;
}