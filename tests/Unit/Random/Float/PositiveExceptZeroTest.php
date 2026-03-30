<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive as PositiveValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The PositiveExceptZero random float generator")]
#[CoversClass(PositiveExceptZero::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(Positive::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(OnlyPositiveExceptZero::class)]
#[UsesClass(PositiveValidator::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class PositiveExceptZeroTest extends GeneratorTest
{
    #[TestDox("generate a positive float except zero.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new PositiveExceptZero(
            $this->faker,
            new OnlyPositiveExceptZero,
            new FloatRange(FloatRange::MICRO, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);
    }
}