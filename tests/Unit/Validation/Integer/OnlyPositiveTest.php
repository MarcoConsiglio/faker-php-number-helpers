<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The OnlyPositive integer validator")]
#[CoversClass(OnlyPositive::class)]
class OnlyPositiveTest extends BaseTestCase
{
    #[TestDox("allows only positive integers.")]
    public function test_range(): void
    {
        /**
         * $min ≥ 0
         * $max ≥ 0
         */
        // Arrange
        $min = +3;
        $max = +5;
        $validator = new OnlyPositive;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(3, $min);
        $this->assertEquals(5, $max);

        /**
         * $min ≥ 0 
         * $max < 0 
         */
        // Arrange
        $min = +3;
        $max = -5;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(3, $min);
        $this->assertEquals(IntRange::MAX, $max);

        /**
         * $min < 0
         * $max ≥ 0
         */
        // Arrange
        $min = -5;
        $max = +7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(0, $min);
        $this->assertEquals(7, $max);

        /**
         * $min < 0
         * $max < 0
         */
        // Arrange
        $min = -5;
        $max = -7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertEquals(0, $min);
        $this->assertEquals(IntRange::MAX, $max);
    }
}