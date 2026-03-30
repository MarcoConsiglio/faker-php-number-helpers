<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use Faker\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The NegativeFraction random float generator")]
#[CoversClass(NegativeFraction::class)]
#[CoversMethod(Validator::class, "hasNoFraction")]
#[UsesClass(FloatRange::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegativeFractions::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class NegativeFractionTest extends GeneratorTest
{
    #[TestDox("generates a float with a fractional part.")]
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
            ->willReturn(3.0, 3.6);
        $generator = new NegativeFraction(
            $faker_mock,
            new OnlyNegativeFractions,
            new FloatRange(FloatRange::MIN_FRACTION, -FloatRange::MICRO)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertEquals(-3.6, $number);

        /**
         * Just one try.
         */
        // Arrange
        $faker_mock = $this->createMock(Generator::class);
        $faker_mock
            ->expects($this->exactly(1))
            ->method("randomFloat")
            ->willReturn(3.6);
        $generator = new NegativeFraction(
            $faker_mock,
            new OnlyNegativeFractions,
            new FloatRange(FloatRange::MIN_FRACTION, -FloatRange::MICRO)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertEquals(-3.6, $number);
    }
}