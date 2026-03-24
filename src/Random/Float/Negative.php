<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;

class Negative extends Generator
{
    public function generate(int $precision): float
    {
        $this->validate();
        return $this->generator->randomFloat(
            $this->normalizePrecision($precision),
            $this->range->start,
            $this->range->end
        );
    }

    protected function validate(): void
    {
        $this->range->validate(new OnlyNegative);
    }
}