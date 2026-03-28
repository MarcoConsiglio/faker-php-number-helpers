<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

/**
 *  The negative random `float` number generator. 
 */
class Negative extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        return $this->generator->randomFloat(
            $this->normalizePrecision($precision),
            $this->range->start,
            $this->range->end
        );
    }

    /**
     * Validate the random range.
     */
    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}