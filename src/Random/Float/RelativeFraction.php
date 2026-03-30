<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;

/**
 * The relative random `float` fraction number generator. 
 */
class RelativeFraction extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        if ($this->validator->areBothPositive($this->range->start, $this->range->end))
            return new PositiveFraction(
                $this->generator,
                new OnlyPositiveFractions,
                $this->range
            )->generate($precision);
        if ($this->validator->areBothNegative($this->range->start, $this->range->end))
            return new NegativeFraction(
                $this->generator,
                new OnlyNegativeFractions,
                $this->range
            )->generate($precision);
        if ($this->generator->boolean())
            return new PositiveFraction(
                $this->generator,
                new OnlyPositiveFractions, 
                new FloatRange(FloatRange::MICRO, $this->range->end)
            )->generate($precision);
        else
            return new NegativeFraction(
                $this->generator,
                new OnlyNegativeFractions,
                new FloatRange($this->range->start, -FloatRange::MICRO)
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