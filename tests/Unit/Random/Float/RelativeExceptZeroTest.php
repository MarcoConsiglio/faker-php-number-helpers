<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative as NegativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeExceptZero as RelativeExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The RelativeExceptZero random float generator")]
#[CoversClass(RelativeExceptZero::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(Negative::class)]
#[UsesClass(NegativeExceptZero::class)]
#[UsesClass(Positive::class)]
#[UsesClass(PositiveExceptZero::class)]
#[UsesClass(NegativeValidator::class)]
#[UsesClass(OnlyNegative::class)]
#[UsesClass(OnlyNegativeExceptZero::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(OnlyNegativeExceptZero::class)]
#[UsesClass(Positive::class)]
#[UsesClass(Relative::class)]
#[UsesClass(RelativeExceptZero::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
#[UsesClass(OnlyPositiveExceptZero::class)]
#[UsesClass(RelativeValidator::class)]
#[UsesClass(RelativeExceptZeroValidator::class)]
class RelativeExceptZeroTest extends GeneratorTest
{
    #[TestDox("generates a relative float except zero.")]
    public function test_random_generation(): void
    {
        /**
         * $min > 0
         * $max > 0
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->faker,
            new FloatRange(FloatRange::MICRO, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->faker,
            new FloatRange(FloatRange::MIN, -FloatRange::MICRO)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);

        /**
         * Relative range
         * Positive outcome
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->trickFakerToGetTrueOut(),
            new FloatRange(FloatRange::MIN, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);

        /**
         * Relative range
         * Negative outcome
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->trickFakerToGetFalseOut(),
            new FloatRange(FloatRange::MIN, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }
}