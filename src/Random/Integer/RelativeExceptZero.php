<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\RelativeExceptZero as RelativeExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class RelativeExceptZero extends Generator
{
    public function generate(): int
    {
        $this->validate();
        if (Validator::areBothPositive($this->range->start, $this->range->end))
            return new PositiveExceptZero($this->generator, $this->range)->generate();
        if (Validator::areBothNegative($this->range->start, $this->range->end))
            return new Negative($this->generator, $this->range)->generate();
        if ($this->generator->boolean)
            return new PositiveExceptZero(
                $this->generator, 
                new IntRange(1, $this->range->end)
            )->generate();
        else
            return new Negative(
                $this->generator,
                new IntRange($this->range->start, -1)
            )->generate();
    }

    protected function validate(): void
    {
        $this->range->validate(new RelativeExceptZeroValidator);
    }
}