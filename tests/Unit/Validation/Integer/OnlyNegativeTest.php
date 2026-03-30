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
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -3;
        $max = -1;
        $validator = new OnlyNegative;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-3, $min);
        $this->assertSame(-1, $max);

        /**
         * $min ≥ 0
         * $max < 0
         */
        // Arrange
        $min = +5;
        $max = -1;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(IntRange::MIN, $min);
        $this->assertSame(-1, $max);

        /**
         * $min < 0
         * $max ≥ 0
         */
        // Arrange
        $min = -7;
        $max = +3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-7, $min);
        $this->assertSame(-1, $max);

        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $min = +3;
        $max = +5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(IntRange::MIN, $min);
        $this->assertSame(-1, $max);

        /**
         * $min = PHP_INT_MIN
         * $max < 0
         */
        // Arrange
        $min = PHP_INT_MIN;
        $max = -3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(IntRange::MIN, $min);
        $this->assertSame(-3, $max);
    }
}