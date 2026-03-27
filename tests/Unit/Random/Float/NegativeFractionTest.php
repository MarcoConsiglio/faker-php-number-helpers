<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Float;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\NegativeFraction;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(NegativeFraction::class)]
#[CoversMethod(Validator::class, "hasNoFraction")]
#[UsesClass(FloatRange::class)]
#[UsesClass(Negative::class)]
#[UsesClass(OnlyNegativeFractions::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
class NegativeFractionTest extends GeneratorTest
{
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new NegativeFraction(
            $this->faker,
            new FloatRange(FloatRange::MIN_FRACTION, -FloatRange::MICRO)
        );

        // Act many times to ensure hitting the while condition.
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();
        $number = $generator->generate();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
    }
}