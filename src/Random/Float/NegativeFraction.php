<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class NegativeFraction extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        $precision = $this->normalizePrecision($precision);
        do {
            $number = $this->generator->randomFloat(
                $precision,
                abs($this->range->end),
                abs($this->range->start)
            );
        } while ($this->validator->hasNoFraction($number));
        return -$number;
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}