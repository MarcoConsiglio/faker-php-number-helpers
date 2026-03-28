<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Feature;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Generator as FloatGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative as NegativeFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeExceptZero as NegativeFloatExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive as PositiveFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveExceptZero as PositiveFloatExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative as RelativeFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeExceptZero as RelativeFloatExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\RelativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Generator as IntegerGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Negative as NegativeInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Positive as PositiveInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\PositiveExceptZero as PositiveIntegerExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Relative as RelativeInteger;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\RelativeExceptZero as RelativeIntegerExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative as OnlyNegativeFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions as OnlyNegativeFractionsValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive as OnlyPositiveFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero as OnlyPositiveFloatExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions as OnlyPositiveFractionsValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeExceptZero as RelativeFloatExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions as RelativeFractionsValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative as OnlyNegativeIntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive as OnlyPositiveIntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero as OnlyPositiveIntegerExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Relative as RelativeIntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\RelativeExceptZero as RelativeIntegerExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator as IntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The WithFakerHelpers trait")]
#[CoversTrait(WithFakerHelpers::class)]
#[UsesClass(IntRange::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(IntegerGenerator::class)]
#[UsesClass(FloatGenerator::class)]
#[UsesClass(PositiveInteger::class)]
#[UsesClass(NegativeInteger::class)]
#[UsesClass(RelativeInteger::class)]
#[UsesClass(PositiveIntegerExceptZero::class)]
#[UsesClass(RelativeIntegerExceptZero::class)]
#[UsesClass(PositiveFloat::class)]
#[UsesClass(NegativeFloat::class)]
#[UsesClass(RelativeFloat::class)]
#[UsesClass(PositiveFloatExceptZero::class)]
#[UsesClass(NegativeFloatExceptZero::class)]
#[UsesClass(RelativeFloatExceptZero::class)]
#[UsesClass(PositiveFraction::class)]
#[UsesClass(NegativeFraction::class)]
#[UsesClass(RelativeFraction::class)]
#[UsesClass(Validator::class)]
#[UsesClass(IntegerValidator::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(OnlyNegativeIntegerValidator::class)]
#[UsesClass(OnlyPositiveIntegerExceptZeroValidator::class)]
#[UsesClass(OnlyPositiveIntegerValidator::class)]
#[UsesClass(RelativeIntegerValidator::class)]
#[UsesClass(RelativeIntegerExceptZeroValidator::class)]
#[UsesClass(OnlyPositiveFloatValidator::class)]
#[UsesClass(OnlyNegativeFloatValidator::class)]
#[UsesClass(RelativeFloatValidator::class)]
#[UsesClass(OnlyPositiveFloatExceptZeroValidator::class)]
#[UsesClass(RelativeFloatExceptZeroValidator::class)]
#[UsesClass(OnlyPositiveFractionsValidator::class)]
#[UsesClass(OnlyNegativeFractionsValidator::class)]
#[UsesClass(RelativeFractionsValidator::class)]
class WithFakerHelpersTest extends BaseTestCase
{
    use WithFakerHelpers;

    #[TestDox("can generate a random integer.")]
    public function test_random_integer(): void
    {
        // Act
        $number = $this->randomInteger();

        // Assert
        $this->assertIsInt($number);
    }

    #[TestDox("can generate a positive random integer.")]
    public function test_positive_random_integer(): void
    {
        // Act
        $number = $this->positiveRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);
    }

    #[TestDox("can generate a negative random integer.")]
    public function test_negative_random_integer(): void
    {
        // Act
        $number = $this->negativeRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);
    }

    #[TestDox("can generate a random integer except for zero.")]
    public function test_non_zero_random_integer(): void
    {
        // Act
        $number = $this->nonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertNotEquals(0, $number);
    }


    #[TestDox("can generate a positive random integer except for zero.")]
    public function test_positive_non_zero_random_integer(): void
    {
        // Act
        $number = $this->positiveNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThan(0, $number);
    }

    #[TestDox("can generate a negative random integer except for zero.")]
    public function test_negative_non_zero_random_integer(): void
    {
        // Act
        $number = $this->negativeNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThanOrEqual(-1, $number);
    }

    #[TestDox("can generate a random float.")]
    public function test_random_float(): void
    {
        /**
         * Min = -PHP_FLOAT_MAX
         * Max = PHP_FLOAT_MAX
         */
        // Act & Assert
        $this->assertIsFloat($this->randomFloat());

        /**
         * Positive min
         * Positive max
         */
        // Act
        $number = $this->randomFloat(1);
        
        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(1, $number);

        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->randomFloat(max: -1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThanOrEqual(-1, $number);

        /**
         * Negative min
         * Positive max
         * Positive outcome
         */
        // Arrange
        $this->injectFaker($this->trickFakerToGetTrueOut());

        // Act
        $number = $this->randomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Negative min
         * Positive max
         * Negative outcome
         */
        // Arrange
        $this->injectFaker($this->trickFakerToGetFalseOut());

        // Act
        $number = $this->randomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }

    #[TestDox("can generate a positive random float.")]
    public function test_positive_random_float(): void
    {
        // Act
        $number = $this->positiveRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);
    }

    #[TestDox("can generate a negative random float.")]
    public function test_negative_random_float(): void
    {
        // Act
        $number = $this->negativeRandomFloat();
        
        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }

    #[TestDox("can generate a random float with a fractional part.")]
    public function test_random_fraction(): void
    {
        // Act
        $number = $this->randomFraction();

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRange(FloatRange::MIN, FloatRange::MAX, $number);
    }

    #[TestDox("can generate a positive random float with a fractional part.")]
    public function test_positive_random_fraction(): void
    {
        // Act
        $number = $this->positiveRandomFraction();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);
        $this->assertIsFraction($number);
    }

    #[TestDox("can generate a negative random float with a fractional part.")]
    public function test_negative_random_fraction(): void
    {
        // Act
        $number = $this->negativeRandomFraction();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
        $this->assertIsFraction($number);
    }

    #[TestDox("can generate a random float except for zero.")]
    public function test_non_zero_random_float(): void
    {
        // Act
        $number = $this->nonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertNotEquals(0, $number);
    }

    #[TestDox("can generate a positive random float except for zero.")]
    public function test_positive_non_zero_random_float(): void
    {
        // Act
        $number = $this->positiveNonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);
    }

    #[TestDox("can generate a negative random float except for zero.")]
    public function test_negative_non_zero_random_float(): void
    {
        // Act
        $number = $this->negativeNonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }

    #[DataProvider("fakeDataProvider")]
    #[TestDox("can be used in PHPUnit data providers.")]
    public function test_faker_with_data_provider(int $number): void
    {
        // Act & Assert
        $this->assertIsInt($number);
    }

    public static function fakeDataProvider(): array
    {
        self::setUpFaker();
        return [
            [self::randomInteger()]
        ];
    }
}