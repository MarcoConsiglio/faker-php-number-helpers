<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyNegative integer validator")]
#[CoversClass(OnlyNegative::class)]
class OnlyNegativeTest extends BaseTestCase
{
    #[TestDox("allows only negative integers.")]
    public function test_range(): void
    {
        /**
         * Negative min
         * Negative max
         */
        // Arrange
        $min = -3;
        $max = -1;
        $validator = new OnlyNegative;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(-3, $min);
        $this->assertEquals(-1, $max);

        /**
         * Positive min
         * Negative max
         */
        // Arrange
        $min = +5;
        $max = -1;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(IntRange::MIN, $min);
        $this->assertEquals(-1, $max);

        /**
         * Negative min
         * Positive max
         */
        // Arrange
        $min = -7;
        $max = +3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(-7, $min);
        $this->assertEquals(-1, $max);

        /**
         * Positive min
         * Positive max
         */
        // Arrange
        $min = +3;
        $max = +5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(IntRange::MIN, $min);
        $this->assertEquals(-1, $max);
    }
}