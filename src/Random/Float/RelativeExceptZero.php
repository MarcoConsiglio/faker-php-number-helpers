<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;

/**
 * The relative non-null random `float` number generator. 
 */
class RelativeExceptZero extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        if ($this->validator->areBothPositive($this->range->start, $this->range->end))
            return new PositiveExceptZero(
                $this->generator,
                new OnlyPositiveExceptZero,
                $this->range
            )->generate($precision);
        if ($this->validator->areBothNegative($this->range->start, $this->range->end))
            return new NegativeExceptZero(
                $this->generator,
                new OnlyNegative,
                $this->range
            )->generate($precision);
        if ($this->generator->boolean())
            return new PositiveExceptZero(
                $this->generator,
                new OnlyPositiveExceptZero,
                new FloatRange(NextFloat::afterZero(), $this->range->end)
            )->generate($precision);
        else
            return new NegativeExceptZero(
                $this->generator,
                new OnlyNegative,
                new FloatRange($this->range->start, NextFloat::beforeZero())
            )->generate($precision);
    }

    /**
     * Validate the random range.
     */
    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}