<?php 
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyPositive float validator")]
#[CoversClass(OnlyPositive::class)]
class OnlyPositiveTest extends BaseTestCase
{
    #[TestDox("allows only positive floats.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new OnlyPositive;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(0.0, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min = -INF
         * $max ≥ 0
         */
        $min = -INF;
        $max = 7.1;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(0.0, $min);
        $this->assertSame(7.1, $max);

        /**
         * $min ≥ 0
         * $max = INF
         */
        // Arrange
        $min = 4.8;
        $max = INF;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(4.8, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $min = 2.8;
        $max = 7.3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(2.8, $min);
        $this->assertSame(7.3, $max);

        /**
         * $min < 0
         * $max ≥ 0
         */
        // Arrange
        $min = -3.7;
        $max = 8.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(0.0, $min);
        $this->assertSame(8.4, $max);

        /**
         * $min ≥ 0
         * $max < 0
         */
        // Arrange
        $min = 4.6;
        $max = -5.3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(4.6, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -8.4;
        $max = -2.4;

        // Act
        $validator->validate($min, $max);

        // Asseert
        $this->assertSame(0.0, $min);
        $this->assertSame(FloatRange::MAX, $max);
    }
}