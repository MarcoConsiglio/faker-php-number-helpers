<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

class NegativeFraction extends Generator
{
    public function generate(int $precision): float
    {
        $this->validate();
        $precision = $this->normalizePrecision($precision);
        do {
            $number = $this->generator->randomFloat(
                $precision,
                $this->range->start,
                $this->range->end
            );
        } while (Validator::hasNoFraction($number));
        return -$number;
    }

    protected function validate(): void
    {
        $this->range->validate(new OnlyNegativeFractions);
    }
}