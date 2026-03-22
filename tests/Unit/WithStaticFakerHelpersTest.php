<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Stubs\Generator;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\WithStaticFakerHelpers;
use Override;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\Runtime\PropertyHook;
use PHPUnit\Framework\MockObject\Stub;
use RoundingMode;

#[TestDox("The WithStaticFakerHelpers trait")]
#[CoversTrait(WithStaticFakerHelpers::class)]
class WithStaticFakerHelpersTest extends BaseTestCase
{
    use WithStaticFakerHelpers;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    #[TestDox("can generate a random integer.")]
    public function test_random_integer(): void
    {
        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->randomInteger(max: -1);

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThanOrEqual(-1, $number);

        /**
         * Positive min
         * Positive max
         */
        // Act
        $number = $this->randomInteger(min: 0);

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Negative min
         * Positive max
         * Positive outcome
         */
        // Arrange
        $this->trickFakerToGetTrueOut();

        // Act
        $number = $this->randomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Negative min
         * Positive max
         * Negative outcome
         */
        // Arrange
        $this->trickFakerToGetFalseOut();

        // Act
        $number = $this->randomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);
    }

    #[TestDox("can generate a positive random integer.")]
    public function test_positive_random_integer(): void
    {
        /**
         * Min = 0
         * Max = PHP_INT_MAX
         */
        // Act
        $number = $this->positiveRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Negative min
         * Max = PHP_INT_MAX
         */
        // Act 
        $number = $this->positiveRandomInteger(-1);

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Min = 0
         * Negative max
         */
        // Act
        $number = $this->positiveRandomInteger(max: -1);

        // Assert
        $this->assertIsInt($number);
        $this->assertInRange(0, 1, $number);

        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->positiveRandomInteger(min: -2, max: -1);

        // Assert
        $this->assertIsInt($number);
        $this->assertInRange(0, 1, $number);
    }

    #[TestDox("can generate a negative random integer.")]
    public function test_negative_random_integer(): void
    {
        /**
         * Min = PHP_INT_MIN + 1
         * Max = -1
         */
        // Act
        $number = $this->negativeRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);

        /**
         * Positive min
         * Max = -1
         */
        // Act
        $number = $this->negativeRandomInteger(1);

        // Assert
        $this->assertIsInt($number);
        $this->assertInRange(-2, -1, $number);

        /**
         * Min = PHP_INT_MIN + 1
         * Positive max
         */
        // Act
        $number = $this->negativeRandomInteger(max: 1);

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThanOrEqual(-1, $number);

        /**
         * Positive min
         * Positive max
         */
        // Act
        $number = $this->negativeRandomInteger(min: 1, max: 1);

        // Assert
        $this->assertIsInt($number);
        $this->assertInRange(-2, -1, $number);
    }

    #[TestDox("can generate a random integer except for zero.")]
    public function test_non_zero_random_integer(): void
    {
        // Act
        $number = $this->nonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number != 0);
    }


    #[TestDox("can generate a positive random integer except for zero.")]
    public function test_positive_non_zero_random_integer(): void
    {
        /**
         * Min = 1
         * Max = PHP_INT_MAX
         */
        // Act
        $number = $this->positiveNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(1, $number);

        /**
         * Negative min
         * Max = PHP_INT_MAX
         */
        // Act
        $number = $this->positiveNonZeroRandomInteger(-1);

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(1, $number);
    }

    #[TestDox("can generate a negative random integer except for zero.")]
    public function test_negative_non_zero_random_integer(): void
    {
        // Act
        $number = $this->negativeNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->lessThanOrEqual(-1, $number);
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
        $this->trickFakerToGetTrueOut();

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
        $this->trickFakerToGetFalseOut();

        // Act
        $number = $this->randomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->lessThan(0, $number);
    }

    #[TestDox("can generate a positive random float.")]
    public function test_positive_random_float(): void
    {
        /**
         * Min = 0
         * Max = PHP_FLOAT_MAX
         */
        // Act
        $number = $this->positiveRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Negative min
         * Max = PHP_FLOAT_MAX
         */
        // Act
        $number = $this->positiveRandomFloat(-1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThanOrEqual(0, $number);

        /**
         * Min = 0
         * Negative max
         */
        // Act
        $number = $this->positiveRandomFloat(max: -1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRange(0, 1, $number);

        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->positiveRandomFloat(-2, -1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRange(0, 1, $number);        
    }

    #[TestDox("can generate a negative random float.")]
    public function test_negative_random_float(): void
    {
        /**
         * Min = -PHP_FLOAT_MAX
         * Max = 0
         */
        // Act
        $number = $this->negativeRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);

        /**
         * Positive min
         * Max = 0
         */
        // Act
        $number = $this->negativeRandomFloat(3);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMaxExcluded(-1, 0, $number);

        /**
         * Min = -PHP_FLOAT_MAX
         * Positive max
         */
        // Act
        $number = $this->negativeRandomFloat(max: 5);

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);

        /**
         * Positive min
         * Positive max
         */
        // Act
        $number = $this->negativeRandomFloat(min: 7, max: 10);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMaxExcluded(-1, 0, $number);

        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->negativeRandomFloat(max: -1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThanOrEqual(-1, $number);
    }

    #[TestDox("can generate a random float with a fractional part.")]
    public function test_random_float_strict(): void
    {
        /**
         * Negative min
         * Negative max
         */
        // Act
        $number = $this->randomFloatStrict(max: -1);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMaxExcluded(-self::STRICT_FLOAT_MAX, 0 , $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);        

        /**
         * Positve min
         * Positive max
         */
        // Act
        $number = $this->randomFloatStrict(min: 0);

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMinExcluded(0, self::STRICT_FLOAT_MAX, $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);     

        /**
         * Negative min
         * Positive max
         * Positive outcome
         */
        // Arrange
        $this->trickFakerToGetTrueOut();

        // Act
        $number = $this->randomFloatStrict();

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMinExcluded(0, self::STRICT_FLOAT_MAX, $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);

        /**
         * Negative min
         * Positive max
         * Negative outcome
         */
        // Arrange
        $this->trickFakerToGetFalseOut();

        // Act
        $number = $this->randomFloatStrict();

        // Assert
        $this->assertIsFloat($number);
        $this->assertInRangeMaxExcluded(-self::STRICT_FLOAT_MAX, 0, $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);
    }

    #[TestDox("can generate a positive random float with a fractional part.")]
    public function test_positive_random_float_strict(): void
    {
        // Act
        $number = $this->positiveRandomFloatStrict();

        // Assert
        $this->assertIsFloat($number);
        $this->assertGreaterThan(0, $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);
    }

    #[TestDox("can generate a negative random float with a fractional part.")]
    public function test_negative_random_float_strict(): void
    {
        // Act
        $number = $this->negativeRandomFloatStrict();

        // Assert
        $this->assertIsFloat($number);
        $this->assertLessThan(0, $number);
        $this->assertNotEquals(round($number, 0, RoundingMode::HalfTowardsZero), $number);
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

    /**
     * Replace the `Faker\Generator` implementetion with one that return `true`
     * every time the `$boolean` property is called.
     */
    protected function trickFakerToGetTrueOut(): void
    {
        $builder = $this->getStubBuilder(Generator::class);
        $builder->onlyMethods([]);
        /** @var Generator&Stub */
        $faker_stub = $builder->getStub();
        $faker_stub->method(PropertyHook::get("boolean"))->willReturn(true);
        self::$faker = $faker_stub;
    }

    /**
     * Replace the `Faker\Generator` implementetion with one that return `false`
     * every time the `$boolean` property is called.
     */
    protected function trickFakerToGetFalseOut(): void
    {
        $builder = $this->getStubBuilder(Generator::class);
        $builder->onlyMethods([]);
        $faker_stub = $builder->getStub();
        $faker_stub->method(PropertyHook::get("boolean"))->willReturn(false);
        self::$faker = $faker_stub;
    }
}