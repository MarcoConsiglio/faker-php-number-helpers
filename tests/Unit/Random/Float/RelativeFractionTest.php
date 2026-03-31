<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The RelativeFraction random float generator")]
#[CoversClass(RelativeFraction::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(NegativeFraction::class)]
#[UsesClass(PositiveFraction::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegativeFractions::class)]
#[UsesClass(OnlyPositiveFractions::class)]
#[UsesClass(Positive::class)]
#[UsesClass(Relative::class)]
#[UsesClass(RelativeFractions::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
#[UsesClass(NextFloat::class)]
class RelativeFractionTest extends GeneratorTest
{
    #[TestDox("generates a relative float with fractional part")]
    public function test_random_generation(): void
    {
        /**
         * $min > 0
         * $max > 0
         */
        // Arrange
        $generator = new RelativeFraction(
            $this->faker,
            new RelativeFractions,
            new FloatRange(NextFloat::afterZero(), FloatRange::MAX_FRACTION)
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
        $generator = new RelativeFraction(
            $this->faker,
            new RelativeFractions,
            new FloatRange(FloatRange::MIN_FRACTION, NextFloat::beforeZero())
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
        $generator = new RelativeFraction(
            $this->trickFakerToGetTrueOut(),
            new RelativeFractions,
            new FloatRange(FloatRange::MIN_FRACTION, FloatRange::MAX_FRACTION)
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
        $generator = new RelativeFraction(
            $this->trickFakerToGetFalseOut(),
            new RelativeFractions,
            new FloatRange(FloatRange::MIN_FRACTION, FloatRange::MAX_FRACTION)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }
}