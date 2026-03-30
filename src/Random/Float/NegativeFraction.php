<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

/**
 * The negative random `float` fraction number generator. 
 */
class NegativeFraction extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
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

    /**
     * Validate the random range.
     */
    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}