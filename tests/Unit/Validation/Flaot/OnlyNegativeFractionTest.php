<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyNegativeFractions;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyNegativeFractions validator")]
#[CoversClass(OnlyNegativeFractions::class)]
class OnlyNegativeFractionTest extends BaseTestCase
{
    #[TestDox("allows only negative floats with fractional part.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new OnlyNegativeFractions;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->isFloat($min, $max);
        $this->assertSame(FloatRange::MIN_FRACTION, $min);
        $this->assertSame(-FloatRange::MICRO, $max);

        /**
         * $min = -INF
         * $max < 0
         */
        // Arrange
        $min = -INF;
        $max = -3.0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->isFloat($min, $max);
        $this->assertSame(FloatRange::MIN_FRACTION, $min);
        $this->assertSame(-3.0, $max);

        /**
         *  $min = $max
         */
        // Arrange
        $min = -4.0;
        $max = -4.0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->isFloat($min, $max);
        $this->assertSame(FloatRange::MIN_FRACTION, $min);
        $this->assertSame(-FloatRange::MICRO, $max);
    }
}