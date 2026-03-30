<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;

/**
 * A random negative `int` number generator.
 */
class Negative extends Generator
{
    /**
     * Generate a random `int` number.
     */
    public function generate(): int
    {
        $this->validate();
        return -$this->generator->numberBetween(
            abs($this->range->end), abs($this->range->start)
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