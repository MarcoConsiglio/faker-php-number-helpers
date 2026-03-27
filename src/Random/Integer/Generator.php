<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

abstract class Generator extends RandomGenerator
{
    public function __construct(
        FakerGenerator $generator,
        Validator $validator, 
        protected IntRange $range
    ) {
        parent::__construct($generator, $validator);
    }

    abstract public function generate(): int;

    abstract protected function validate(): void;
}