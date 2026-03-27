<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Relative as RelativeInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class Relative extends Generator
{
    public function generate(): int
    {
        $this->validate();
        if ($this->validator->areBothPositive($this->range->start, $this->range->end))
            return new Positive(
                $this->generator,
                new OnlyPositive,
                $this->range
            )->generate();
        if ($this->validator->areBothNegative($this->range->start, $this->range->end))
            return new Negative(
                $this->generator,
                new OnlyNegative,
                $this->range
            )->generate();
        $this->validate();
        if ($this->generator->boolean())
            return new Positive(
                $this->generator,
                new OnlyPositive,
                new IntRange(0, $this->range->end)
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
        $this->range->validate(new RelativeInteger);
    }
}