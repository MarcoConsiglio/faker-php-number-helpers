<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;

class PositiveExceptZero extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        return 
            new Positive(
                $this->generator,
                $this->validator,
                $this->range)
            ->generate($precision);
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}