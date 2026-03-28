<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero;
class RelativeExceptZero extends Generator
{
    public function generate(): int
    {
        $this->validate();
        if ($this->validator->areBothPositive($this->range->start, $this->range->end))
            return new PositiveExceptZero(
                $this->generator,
                new OnlyPositiveExceptZero,
                $this->range
            )->generate();
        if ($this->validator->areBothNegative($this->range->start, $this->range->end))
            return new Negative(
                $this->generator,
                new OnlyNegative,
                $this->range
            )->generate();
        if ($this->generator->boolean())
            return new PositiveExceptZero(
                $this->generator,
                new OnlyPositiveExceptZero, 
                new IntRange(1, $this->range->end)
            )->generate();
        else
            return new Negative(
                $this->generator,
                new OnlyNegative,
                new IntRange($this->range->start, -1)
            )->generate();
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}