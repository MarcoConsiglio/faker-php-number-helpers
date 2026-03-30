<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use Faker\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\PositiveFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The PositiveFraction random float generator")]
#[CoversClass(PositiveFraction::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(OnlyPositiveFractions::class)]
#[UsesClass(Positive::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class PositiveFractionTest extends GeneratorTest
{
    #[TestDox("generates a positive float with fractional part.")]
    public function test_random_generation(): void
    {
        /**
         * More than one try.
         */
        // Arrange
        $faker_mock = $this->createMock(Generator::class);
        $faker_mock
            ->expects($this->exactly(2))
            ->method("randomFloat")
            ->willReturn(5.0, 5.5);
        $generator = new PositiveFraction(
            $faker_mock,
            new OnlyPositiveFractions,
            new FloatRange(FloatRange::MICRO, FloatRange::MAX_FRACTION)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertSame(5.5, $number);

        /**
         * Just one try.
         */
        // Arrange
        $faker_mock = $this->createMock(Generator::class);
        $faker_mock
            ->expects($this->exactly(1))
            ->method("randomFloat")
            ->willReturn(5.5);
        $generator = new PositiveFraction(
            $faker_mock,
            new OnlyPositiveFractions,
            new FloatRange(FloatRange::MICRO, FloatRange::MAX_FRACTION)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertSame(5.5, $number);
    }
}