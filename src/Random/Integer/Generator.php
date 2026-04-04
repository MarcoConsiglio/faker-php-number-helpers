<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer;

use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

/**
 * A random `int` number generator.
 */
abstract class Generator extends RandomGenerator
{
    /**
     * Construct the `Generator`.
     */
    public function __construct(
        FakerGenerator $generator,
        Validator $validator, 
        protected IntRange $range
    ) {
        parent::__construct($generator, $validator);
    }

    /**
     * Generate a random `int` number.
     */
    abstract public function generate(): int;
}