<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;

class Positive extends Generator
{
    public function generate(): int
    {
        $this->validate();
        return $this->generator->numberBetween(
            $this->range->start, 
            $this->range->end
        );
    }

    protected function validate(): void
    {
        $this->range->validate($this->validator);
    }
}