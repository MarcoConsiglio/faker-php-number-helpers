<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

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
        // Arrange
        $generator = new PositiveFraction(
            $this->faker,
            new FloatRange(FloatRange::MICRO, FloatRange::MAX_FRACTION)
        );

        // Act many times to hit the while condition
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);
    }
}