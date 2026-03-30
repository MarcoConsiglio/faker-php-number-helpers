<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random;

use Faker\Factory;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;

abstract class GeneratorTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (! isset($this->faker)) {
            $this->faker = Factory::create(Factory::DEFAULT_LOCALE);
        }
    }
} 