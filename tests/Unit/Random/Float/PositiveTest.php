<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive as PositiveValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Positive random float generator")]
#[CoversClass(Positive::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(PositiveValidator::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class PositiveTest extends GeneratorTest
{
    #[TestDox("generates a positive float.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new Positive(
            $this->faker,
            new OnlyPositive,
            new FloatRange(0, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);
    }
}