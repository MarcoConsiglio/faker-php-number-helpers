<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeExceptZero as RelativeExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class RelativeExceptZero extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        if (Validator::areBothPositive($this->range->start, $this->range->end))
            return new PositiveExceptZero(
                $this->generator, 
                $this->range
            )->generate($precision);
        if (Validator::areBothNegative($this->range->start, $this->range->end))
            return new NegativeExceptZero(
                $this->generator,
                $this->range
            )->generate($precision);
        if ($this->generator->boolean())
            return new PositiveExceptZero(
                $this->generator,
                new FloatRange(FloatRange::MICRO, $this->range->end)
            )->generate($precision);
        else
            return new NegativeExceptZero(
                $this->generator,
                new FloatRange($this->range->start, -FloatRange::MICRO)
            )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate(new RelativeExceptZeroValidator);
    }
}