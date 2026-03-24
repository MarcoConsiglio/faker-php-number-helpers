<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

/**
 * The idea of a validation strategy.
 */
interface Strategy
{
    public function validate(int &$min, int &$max): void;
}