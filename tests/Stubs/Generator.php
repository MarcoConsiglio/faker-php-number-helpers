<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Stubs;

use Faker\Generator as FakerGenerator;

class Generator extends FakerGenerator
{
    public function boolean($chanceOfGettingTrue = 50): bool
    {
        return parent::boolean($chanceOfGettingTrue);
    }
}