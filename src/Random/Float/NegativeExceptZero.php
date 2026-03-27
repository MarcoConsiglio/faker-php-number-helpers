<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeExceptZero;

class NegativeExceptZero extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        return new Negative(
            $this->generator, 
            $this->range
        )->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate(new OnlyNegativeExceptZero);
    }
}