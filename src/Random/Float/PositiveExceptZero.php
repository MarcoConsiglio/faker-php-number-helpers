<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;

class PositiveExceptZero extends Generator
{
    public function generate(int $precision): float
    {
        $this->validate();
        return 
            new Positive($this->generator, $this->range)
            ->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate(new OnlyPositiveExceptZero);
    }
}