<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The NegativeExceptZero random float generator")]
#[CoversClass(NegativeExceptZero::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegative::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class NegativeExceptZeroTest extends GeneratorTest
{
    #[TestDox("generates a negative float except zero.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new NegativeExceptZero(
            $this->faker,
            new OnlyNegative,
            new FloatRange(FloatRange::MIN, -FloatRange::MICRO)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }
}