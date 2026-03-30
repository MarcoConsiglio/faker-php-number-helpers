<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest as RandomGeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClassesThatExtendClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversMethod(Generator::class, "normalizePrecision")]
#[UsesClass(FloatRange::class)]
#[UsesClass(Generator::class)]
#[UsesClass(RandomGenerator::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(Positive::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class GeneratorTest extends RandomGeneratorTest
{
    public function test_normalize_precision(): void
    {
        // Arrange
        $generator = new Positive(
            $this->faker,
            new OnlyPositive,
            new FloatRange(0, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate(25);

        // Assert
        $this->assertIsFloat($number);
    }
}