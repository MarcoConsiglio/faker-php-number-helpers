<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive as Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative as NegativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive as PositiveValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Relative random float generator")]
#[CoversClass(Relative::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(Positive::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(PositiveValidator::class)]
#[UsesClass(RelativeValidator::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
#[UsesClass(Negative::class)]
#[UsesClass(NegativeValidator::class)]
#[UsesClass(OnlyNegative::class)]
#[UsesClass(Validator::class)]
class RelativeTest extends GeneratorTest
{
    #[TestDox("generates a relative float.")]
    public function test_random_generation(): void
    {
        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $generator = new Relative(
            $this->faker,
            new FloatRange(0, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $generator = new Relative(
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
        $generator = new Relative(
            $this->trickFakerToGetTrueOut(),
            new FloatRange(FloatRange::MIN, FloatRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Relative range
         * Negative outcome
         */
        // Arrange
        $generator = new Relative(
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