<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeExceptZero;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyNegativeExceptZero float validator")]
#[CoversClass(OnlyNegativeExceptZero::class)]
class OnlyNegativeExceptZeroTest extends BaseTestCase
{
    #[TestDox("allows only negative floats except zero.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new OnlyNegativeExceptZero;

        // Act
        $validator->validate($min, $max);

        // Assert
        $min = -INF;
        $max = +3.7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min = -INF
         * $max ≥ 0
         */
        // Arrange
        $min = -INF;
        $max = +3.7;

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
        $max = -3.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-3.5, $max);

        /**
         * $min ≥ 0
         * $max = INF
         */
        // Arrange
        $min = 0;
        $max = INF;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min < 0
         * $max = INF
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
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -8.4;
        $max = -3.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-8.4, $min);
        $this->assertSame(-3.5, $max);

        /**
         * $min ≥ 0
         * $max < 0
         */
        // Arrange
        $min = +7.4;
        $max = -3.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-3.4, $max);     
        
        /**
         * $min < 0
         * $max ≥ 0
         */
        // Arrange
        $min = -7.4;
        $max = +3.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-7.4, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $min = +7.4;
        $max = +3.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(-FloatRange::MICRO, $max);
    }
}