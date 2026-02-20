<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use PHPUnit\Framework\TestCase;

class WithFakerHelpersTest extends TestCase
{
    use WithFakerHelpers;

    const float MAX = 1_000_000.0;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    public function test_random_integer(): void
    {
        // Act & Assert
        $this->assertIsInt($this->randomInteger());
    }

    public function test_positive_random_integer(): void
    {
        // Act
        $number = $this->positiveRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number >= 0);
    }

    public function test_negative_random_integer(): void
    {
        // Act
        $number = $this->negativeRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number < 0);
    }

    public function test_positive_non_zero_random_integer(): void
    {
        // Act
        $number = $this->positiveNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number >= 1);
    }

    public function test_negative_non_zero_random_integer(): void
    {
        // Act
        $number = $this->negativeNonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number < 0);
    }

    public function test_non_zero_random_integer(): void
    {
        // Act
        $number = $this->nonZeroRandomInteger();

        // Assert
        $this->assertIsInt($number);
        $this->assertTrue($number != 0);
    }

    public function test_random_float(): void
    {
        // Act & Assert
        $this->assertIsFloat($this->randomFloat());
    }

    public function test_random_float_strict(): void
    {
        // Act
        $number = $this->randomFloatStrict(max: $this::MAX);

        // Assert
        $this->assertIsFloat($number);
        $this->assertFalse(intval($number) == $number);
    }

    public function test_positive_random_float_strict(): void
    {
        // Act
        $number = $this->positiveRandomFloatStrict(max: $this::MAX);

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number > 0);
        $this->assertFalse(intval($number) == $number);
    }

    public function test_negative_random_float_strict(): void
    {
        // Act
        $number = $this->negativeRandomFloatStrict(max: $this::MAX);

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number < 0);
        $this->assertFalse(intval($number) == $number);
    }

    public function test_positive_random_float(): void
    {
        // Act
        $number = $this->positiveRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number >= 0);
    }

    public function test_negative_random_float(): void
    {
        // Act
        $number = $this->negativeRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number < 0);
    }

    public function test_positive_non_zero_random_float(): void
    {
        // Act
        $number = $this->positiveNonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number > 0);
    }

    public function test_negative_non_zero_random_float(): void
    {
        // Act
        $number = $this->negativeNonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number < 0);        
    }

    public function test_non_zero_random_float(): void
    {
        // Act
        $number = $this->nonZeroRandomFloat();

        // Assert
        $this->assertIsFloat($number);
        $this->assertTrue($number != 0);
    }
}