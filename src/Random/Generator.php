<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Random;

use Faker\Generator as FakerGenerator;

abstract class Generator
{
    public function __construct(protected FakerGenerator &$generator) {}
}