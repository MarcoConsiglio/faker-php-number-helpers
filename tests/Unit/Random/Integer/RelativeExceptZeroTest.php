<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\PositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\RelativeExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\RelativeExceptZero as RelativeExceptZeroValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator as IntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The RelativeExceptZero random integer generator")]
#[CoversClass(RelativeExceptZero::class)]
#[UsesClass(IntRange::class)]
#[UsesClass(PositiveExceptZero::class)]
#[UsesClass(OnlyPositiveExceptZero::class)]
#[UsesClass(RelativeExceptZeroValidator::class)]
#[UsesClass(IntegerValidator::class)]
#[UsesClass(Validator::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegative::class)]
class RelativeExceptZeroTest extends GeneratorTest
{
    #[TestDox("generates a relative integer except zero.")]
    public function test_random_generation(): void
    {
        /**
         * $min > 0
         * $max > 0
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->faker,
            new IntRange(1, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThan(0, $number);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $generator = new RelativeExceptZero(
            $this->faker,
            new IntRange(IntRange::MIN, -1)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);

        /**
         * Relative range
         * Positive outcome
         */
        // Arrange
        $this->injectFakerMock($this->trickFakerToGetTrueOut());
        $generator = new RelativeExceptZero(
            $this->faker,
            new IntRange(IntRange::MIN, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThan(0, $number);

        /**
         * Relative range
         * Negative outcome
         */
        // Arrange
        $this->injectFakerMock($this->trickFakerToGetFalseOut());
        $generator = new RelativeExceptZero(
            $this->faker,
            new IntRange(IntRange::MIN, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);
    }
}