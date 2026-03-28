<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

/**
 * The negative non-null random `float` number generator.  
 */
class NegativeExceptZero extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        return new Negative(
            $this->generator,
            $this->validator, 
            $this->range
        )->generate($precision);
    }

    /**
     * Validate the random range.
     * 
     * @codeCoverageIgnore
     */
    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}