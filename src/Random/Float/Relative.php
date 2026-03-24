<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class Relative extends Generator
{
    public function generate(int $precision): float
    {
        $this->validate();
        if (Validator::areBothPositive($this->range->start, $this->range->end))
            return new Positive($this->generator, $this->range)->generate($precision);
        if (Validator::areBothNegative($this->range->start, $this->range->end))
            return new Negative($this->generator, $this->range)->generate($precision);
        if ($this->generator->boolean)
            return new Positive(
                $this->generator, 
                new FloatRange(0, $this->range->end)
            )->generate($precision);
        else
            return new Negative(
                $this->generator,
                new FloatRange($this->range->start, -PHP_FLOAT_MIN)
            )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate(new RelativeValidator);
    }
}