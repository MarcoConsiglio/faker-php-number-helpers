<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative as NegativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The Negative random float generator")]
#[CoversClass(Negative::class)]
#[CoversClass(FloatRange::class)]
#[CoversClass(NegativeValidator::class)]
#[CoversClass(OnlyNegative::class)]
#[CoversClass(FloatValidator::class)]
#[CoversClass(Validator::class)]
class NegativeTest extends GeneratorTest
{
    #[TestDox("generates a negative float.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new Negative(
            $this->faker,
            new FloatRange(FloatRange::MIN, -FloatRange::MICRO)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }
}