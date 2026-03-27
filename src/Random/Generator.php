<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random;

use Faker\Generator as FakerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;

abstract class Generator
{
    public function __construct(
        protected FakerGenerator $generator, 
        protected Validator $validator
    ) {

    }
}