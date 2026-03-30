<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeExceptZero;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The RelativeExceptZero float validato")]
#[CoversClass(RelativeExceptZero::class)]
class RelativeExceptZeroTest extends BaseTestCase
{
    #[TestDox("allows all float except zero.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new RelativeExceptZero;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min = 0
         * $max ≠ 0
         */
        // Arrange
        $min = 0;
        $max = +5.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(5.4, $max);

        /**
         * $min ≠ 0
         * $max = 0
         */
        // Arrange
        $min = -4.1;
        $max = 0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-4.1, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min = 0
         * $max = 0
         */
        // Arrange
        $min = 0;
        $max = 0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(FloatRange::MAX, $max);
    }
}