<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveZeroExcluded;

class PositiveZeroExcluded extends Generator
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
        $this->range->validate(new OnlyPositiveZeroExcluded);
    }
}