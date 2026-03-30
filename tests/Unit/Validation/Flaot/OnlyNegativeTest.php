<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegative;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyNegative float validator")]
#[CoversClass(OnlyNegative::class)]
class OnlyNegativeTest extends BaseTestCase
{
    #[TestDox("allows only negative floats.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new OnlyNegative;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min = -INF
         * $max < 0
         */
        // Arrange
        $min = -INF;
        $max = -3.7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-3.7, $max);

        /**
         * $min = -INF
         * $max ≥ 0
         */
        // Arrange
        $min = -INF;
        $max = +5.8;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min < 0
         * $max = -INF
         */
        // Arrange
        $min = -5.7;
        $max = INF;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-5.7, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min ≥ 0
         * $max = -INF
         */
        // Arrange
        $min = 3.4;
        $max = INF;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);    
        
        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -2.8;
        $max = -0.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-2.8, $min);
        $this->assertSame(-0.4, $max);

        /**
         * $min ≥ 0
         * $max < 0
         */
        // Arrange
        $min = +7.2;
        $max = -8.3;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-8.3, $max);

        /**
         * $min < 0
         * $min ≥ 0
         */
        // Arrange
        $min = -5.3;
        $max = +47.1;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-5.3, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $min = +7.8;
        $max = +12.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);
    }
}