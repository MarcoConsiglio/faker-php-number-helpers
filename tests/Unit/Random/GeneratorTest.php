<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random;

use Faker\Factory;
use Faker\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;

abstract class GeneratorTest extends BaseTestCase
{
    protected Generator $generator;

    protected function setUp(): void
    {
        parent::setUp();
        if (! isset($this->generator)) {
            $this->generator = Factory::create(Factory::DEFAULT_LOCALE);
        }
    }
} 