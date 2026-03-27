<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;

class Negative extends Generator
{
    public function generate(): int
    {
        $this->validate();
        return -$this->generator->numberBetween(
            abs($this->range->end), abs($this->range->start)
        );
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}