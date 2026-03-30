<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Flaot;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\RelativeFractions;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The RelativeFractions float validator")]
#[CoversClass(RelativeFractions::class)]
class RelativeFractionsTest extends BaseTestCase
{
    #[TestDox("allows all float with fractional part.")]
    public function test_range(): void
    {
        /**
         * $min = -INF
         * $max = INF
         */
        // Arrange
        $min = -INF;
        $max = INF;
        $validator = new RelativeFractions;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN_FRACTION, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);

        /**
         * $min = $max
         */
        // Arrange
        $min = 5.0;
        $max = $min;
        
        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(FloatRange::MIN_FRACTION, $min);
        $this->assertSame(FloatRange::MAX_FRACTION, $max);
    }
}