<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

/**
 * An `int` validation strategy.
 */
interface Strategy
{
    /**
     * Validate the range.
     */
    public function validate(int &$min, int &$max): void;
}