<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;

class RelativeExceptZero extends Generator
{
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
                new FloatRange(FloatRange::MICRO, $this->range->end)
            )->generate($precision);
        else
            return new NegativeExceptZero(
                $this->generator,
                new OnlyNegative,
                new FloatRange($this->range->start, -FloatRange::MICRO)
            )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}