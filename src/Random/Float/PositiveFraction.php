<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class PositiveFraction extends Generator
{
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        $precision = $this->normalizePrecision($precision);
        do {
            $number = $this->generator->randomFloat(
                $precision,
                $this->range->start,
                $this->range->end
            );
        } while ($this->validator->hasNoFraction($number));
        return $number;
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}