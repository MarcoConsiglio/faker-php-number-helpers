<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Relative;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The Relative float validator")]
#[CoversClass(Relative::class)]
class RelativeTest extends BaseTestCase
{
    #[TestDox("allows every floats.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new Relative;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min = -INF
         * $max ≠ INF
         */
        // Arrange
        $min = -INF;
        $max = 4.7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN, $min);
        $this->assertSame(4.7, $max);

        /**
         * $min ≠ -INF
         * $max = INF
         */
        // Arrange
        $min = -4.6;
        $max = INF;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-4.6, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min ≠ -INF
         * $max ≠ INF
         */
        // Arrange
        $min = -4.5;
        $max = +8.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-4.5, $min);
        $this->assertSame(8.4, $max);

        /**
         * $min > $max
         */
        // Arrange
        $min = 8.6;
        $max = 2.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(2.5, $min);
        $this->assertSame(8.6, $max);
    }
}