<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;

abstract class Generator extends RandomGenerator
{
    public function __construct(
        FakerGenerator &$generator, 
        protected IntRange $range
    ) {
        parent::__construct($generator);
    }

    abstract public function generate(): int;

    abstract protected function validate(): void;
}