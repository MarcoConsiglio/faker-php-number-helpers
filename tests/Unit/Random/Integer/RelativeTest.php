<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Relative;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Relative as RelativeValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator as IntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Relative random integer generator")]
#[CoversClass(Relative::class)]
#[CoversMethod(Validator::class, "areBothNegative")]
#[CoversMethod(Validator::class, "areBothPositive")]
#[UsesClass(IntRange::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegative::class)]
#[UsesClass(RelativeValidator::class)]
#[UsesClass(IntegerValidator::class)]
#[UsesClass(Positive::class)]
#[UsesClass(OnlyPositive::class)]
class RelativeTest extends GeneratorTest
{
    #[TestDox("generates a relative integer.")]
    public function test_random_generation(): void
    {
        /**
         * Negative range
         */
        // Arrange
        $generator = new Relative(
            $this->faker,
            new RelativeValidator,
            new IntRange(IntRange::MIN, -1)
        );

        // Act 
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);

        /**
         * Positive range
         */
        // Arrange
        $generator = new Relative(
            $this->faker,
            new RelativeValidator,
            new IntRange(0, IntRange::MAX)
        );

        // Act 
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Relative range
         * Positive outcome
         */
        // Arrange
        $generator = new Relative(
            $this->trickFakerToGetTrueOut(),
            new RelativeValidator,
            new IntRange(IntRange::MIN, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Relative range
         * Negative outcome
         */
        // Arrange
        $generator = new Relative(
            $this->trickFakerToGetFalseOut(),
            new RelativeValidator,
            new IntRange(IntRange::MIN, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);
    }
}