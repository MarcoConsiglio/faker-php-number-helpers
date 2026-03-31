<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Generator as FloatGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Negative as NegativeGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Positive as PositiveGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Float\Relative as RelativeGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Generator as RandomGenerator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Negative as NegativeFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative as OnlyNegativeFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive as OnlyPositiveFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Positive as PositiveFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative as RelativeFloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\UsesTrait;
use PHPUnit\Framework\TestCase;

#[TestDox("The NextFloat class")]
#[CoversClass(NextFloat::class)]
#[UsesClass(FloatRange::class)]
#[UsesClass(FloatGenerator::class)]
#[UsesClass(PositiveGenerator::class)]
#[UsesClass(NegativeGenerator::class)]
#[UsesClass(RelativeGenerator::class)]
#[UsesClass(RandomGenerator::class)]
#[UsesClass(NegativeFloatValidator::class)]
#[UsesClass(PositiveFloatValidator::class)]
#[UsesClass(OnlyPositiveFloatValidator::class)]
#[UsesClass(OnlyNegativeFloatValidator::class)]
#[UsesClass(RelativeFloatValidator::class)]
#[UsesClass(FloatValidator::class)]
#[UsesClass(Validator::class)]
#[UsesTrait(WithFakerHelpers::class)]
class NextFloatTest extends TestCase
{
    use WithFakerHelpers;

    protected function setUp(): void
    {
        parent::setUp();
        self::setUpFaker();
    }

    #[TestDox("return the next adjacent float.")]
    public function test_after(): void
    {
        // Arrange
        $number = $this->randomFloat();

        // Act & Assert
        $this->assertIsFloat(NextFloat::after($number));
    }

    #[TestDox("return PHP_FLOAT_MIN as the next adjacent float near to zero.")]
    public function test_after_when_zero(): void
    {
        // Act & Assert
        $this->assertSame(PHP_FLOAT_MIN, NextFloat::after(0.0));
    }

    #[TestDox("return the previous adjacent float.")]
    public function test_before(): void
    {
        // Arrange
        $number = $this->randomFloat();

        // Act & Assert
        $this->assertIsFloat(NextFloat::before($number));
    }

    #[TestDox("return PHP_FLOAT_MIN as the previous adjacent float near to zero.")]
    public function test_before_when_zero(): void
    {
        // Act & Assert
        $this->assertSame(-PHP_FLOAT_MIN, NextFloat::before(0.0));
    }

    #[TestDox("return the next float number near to zero.")]
    public function test_after_zero(): void
    {
        // Act
        $number = NextFloat::afterZero();

        // Assert
        $this->assertSame(PHP_FLOAT_MIN, $number);
    }

    #[TestDox("return the previous float number near to zero.")]
    public function test_before_zero(): void
    {
        // Act
        $number = NextFloat::beforeZero();

        // Assert
        $this->assertSame(-PHP_FLOAT_MIN, $number);
    }
}