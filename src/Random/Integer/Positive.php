<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

/**
 * A random positive `int` number generator.
 */
class Positive extends Generator
{
    /**
     * Generate a random `int` number.
     */
    public function generate(): int
    {
        $this->validate();
        return $this->generator->numberBetween(
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