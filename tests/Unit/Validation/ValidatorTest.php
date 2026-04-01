<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation;

use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The Validator abstract class")]
#[CoversClass(Validator::class)]
class ValidatorTest extends BaseTestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new class extends Validator {};
    }

    #[TestDox("can compare if two values are equal.")]
    public function test_are_both_equal(): void
    {
        /**
         * True outcome
         */
        // Arrange
        $value_1 = -3;
        $value_2 = -7;

        // Act & Assert
        $this->assertTrue($this->validator->areBothNegative($value_1, $value_2));

        /**
         * False outcome
         */
        // Arrange
        $value_1 = +6;
        $value_2 = -5;

        // Act & Assert
        $this->assertFalse($this->validator->areBothNegative($value_1, $value_2));
    }

    #[TestDox("can compare if two values are different.")]
    public function test_different(): void
    {
        /**
         * True outcome
         */
        // Arrange
        $value_1 = 5;
        $value_2 = -4;

        // Act & Assert
        $this->assertTrue($this->validator->different($value_1, $value_2));

        /**
         * False outcome
         */
        // Arrange
        $value_2 = $value_1;

        // Act & Assert
        $this->assertFalse($this->validator->different($value_1, $value_2));
    }

    #[TestDox("can compare if a value is greater than or equal to another value.")]
    public function test_greater_than_or_equal(): void
    {
        /**
         * True outcome
         */
        // Arrange
        $value_1 = 6;
        $value_2 = 4;
        $value_3 = $value_1;

        // Act & Assert
        $this->assertTrue($this->validator->greaterThanOrEqual($value_1, $value_2));
        $this->assertTrue($this->validator->greaterThanOrEqual($value_1, $value_3));

        /**
         * False outcome
         */
        // Act & Assert
        $this->assertFalse($this->validator->greaterThanOrEqual($value_2, $value_1));
    }

    #[TestDox("can compare if a value is greater than another value.")]
    public function test_greater_than(): void
    {
        /**
         * True outcome
         */
        // Arrange
        $value_1 = 6;
        $value_2 = 3;

        // Act & Assert
        $this->assertTrue($this->validator->greaterThan($value_1, $value_2));

        /**
         * False outcome
         */
        // Act & Assert
        $this->assertFalse($this->validator->greaterThan($value_2, $value_1));
    }

    #[TestDox("can compare if a value is less than another value.")]
    public function test_less_than(): void
    {
        /**
         * True outcome 
         */
        // Arrange
        $value_1 = 3;
        $value_2 = 9;

        // Act & Assert
        $this->assertTrue($this->validator->lessThan($value_1, $value_2));

        /**
         * False outcome
         */
        // Act & Assert
        $this->assertFalse($this->validator->lessThan($value_2, $value_1));
    }
}