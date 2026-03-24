<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float;

/**
 * The idea of a validation strategy.
 */
interface Strategy
{
    public function validate(float &$min, float &$max): void;
}