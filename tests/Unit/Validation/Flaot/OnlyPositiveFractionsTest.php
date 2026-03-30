<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveFractions;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyPositiveFractions float validator")]
#[CoversClass(OnlyPositiveFractions::class)]
class OnlyPositiveFractionsTest extends BaseTestCase
{
    #[TestDox("allows only positive floats with fractional part.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new OnlyPositiveFractions;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MICRO, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);

        /**
         * $min = $max
         */
        // Arrange
        $min = 5.4;
        $max = $min;
        
        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MICRO, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);

        /**
         * $min < 0
         * $max > 0
         */
        // Arrange
        $min = -4.8;
        $max = 3.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MICRO, $min);
        $this->assertSame(3.5, $max);

        /**
         * $min > 0
         * $max < 0
         */
        // Arrange
        $min = +4.8;
        $max = -3.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(4.8, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -4.8;
        $max = -3.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MICRO, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);
    }
}