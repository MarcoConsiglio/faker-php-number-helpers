<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositiveExceptZero;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The OnlyPositiveExceptZero float validator")]
#[CoversClass(OnlyPositiveExceptZero::class)]
#[UsesClass(NextFloat::class)]
class OnlyPositiveExceptZeroTest extends BaseTestCase
{
    #[TestDox("allows only positive floats except zero.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = INF;
        $max = -INF;
        $validator = new OnlyPositiveExceptZero;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(NextFloat::afterZero(), $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min < 0
         * $max > 0
         */
        // Arrange
        $min = -3.5;
        $max = +7.4;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(NextFloat::afterZero(), $min);
        $this->assertSame(7.4, $max);

        /**
         * $min > 0
         * $max < 0
         */
        // Arrange
        $min = +6.3;
        $max = -2.5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(6.3, $min);
        $this->assertSame(FloatRange::MAX, $max);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -3.7;
        $max = -7.8;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(NextFloat::afterZero(), $min);
        $this->assertSame(FloatRange::MAX, $max);
    }
}