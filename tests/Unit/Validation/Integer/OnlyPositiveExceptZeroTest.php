<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyPositiveExceptZero integer validator")]
#[CoversClass(OnlyPositiveExceptZero::class)]
class OnlyPositiveExceptZeroTest extends BaseTestCase
{
    #[TestDox("allows only positive integers except zero.")]
    public function test_range(): void
    {
        /**
         * $min > 0
         * $max > 0
         */
        // Arrange
        $min = +3;
        $max = +7;
        $validator = new OnlyPositiveExceptZero;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(3, $min);
        $this->assertEquals(7, $max);

        /**
         * $min ≤ 0
         * $max > 0
         */
        // Arrange
        $min = 0;
        $max = +7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(1, $min);
        $this->assertEquals(7, $max);

        /**
         * $min > 0
         * $max ≤ 0
         */
        // Arrange
        $min = +4;
        $max = 0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(4, $min);
        $this->assertEquals(IntRange::MAX, $max);

        /**
         * $min ≤ 0
         * $max ≤ 0
         */
        // Arrange
        $min = 0;
        $max = 0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(1, $min);
        $this->assertEquals(IntRange::MAX, $max);

    }
}