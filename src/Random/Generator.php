<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random;

use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

/**
 * A random `Generator`
 */
abstract class Generator
{
    public function __construct(
        protected FakerGenerator $generator, 
        protected Validator $validator
    ) {}

    /**
     * Validate the random range.
     */
    abstract protected function validate(): void;
}