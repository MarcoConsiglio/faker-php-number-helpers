<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class RelativeFraction extends Generator
{
    public function generate(int $precision): float
    {
        $this->validate();
        if (Validator::areBothPositive($this->range->start, $this->range->end))
            return new PositiveFraction($this->generator, $this->range)->generate($precision);
        if (Validator::areBothNegative($this->range->start, $this->range->end))
            return new NegativeFraction($this->generator, $this->range)->generate($precision);
        if ($this->generator->boolean)
            return new PositiveFraction(
                $this->generator, 
                new FloatRange(FloatRange::MICRO, $this->range->end)
            )->generate($precision);
        else
            return new NegativeFraction(
                $this->generator,
                new FloatRange($this->range->start, -FloatRange::MICRO)
            )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate(new RelativeFractions);
    }
}