<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Float;

/**
 * The positive non-null random `float` number generator. 
 */
class PositiveExceptZero extends Generator
{
    /**
     * Generate a `float` number with `$precision` decimal places.
     */
    public function generate(int $precision = PHP_FLOAT_DIG): float
    {
        $this->validate();
        return 
            new Positive(
                $this->generator,
                $this->validator,
                $this->range)
            ->generate($precision);
    }

    /**
     * Validate the random range.
     */
    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}