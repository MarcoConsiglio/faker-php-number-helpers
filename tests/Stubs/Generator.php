<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Stubs;

use Faker\Generator as FakerGenerator;

class Generator extends FakerGenerator
{
    public bool $boolean {
        get { return parent::$boolean; }
    }
}