<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveZeroExcluded;

/**
 * A random positive non-null `int` number generator.
 */
class PositiveExceptZero extends Generator
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