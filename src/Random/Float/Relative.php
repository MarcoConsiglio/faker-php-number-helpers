<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;

class Relative extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        if ($this->validator->areBothPositive($this->range->start, $this->range->end))
            return new Positive(
                $this->generator, 
                new OnlyPositive, 
                $this->range
            )->generate($precision);
        if ($this->validator->areBothNegative($this->range->start, $this->range->end))
            return new Negative(
                $this->generator, 
                new OnlyNegative, 
                $this->range
            )->generate($precision);
        if ($this->generator->boolean())
            return new Positive(
                $this->generator,
                new OnlyPositive, 
                new FloatRange(0, $this->range->end)
            )->generate($precision);
        else
            return new Negative(
                $this->generator,
                new OnlyNegative,
                new FloatRange($this->range->start, -PHP_FLOAT_MIN)
            )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}