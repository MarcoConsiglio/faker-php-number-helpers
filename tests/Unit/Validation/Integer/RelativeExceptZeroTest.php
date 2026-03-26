<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\RelativeExceptZero;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The RelativeExceptZero integer validator")]
#[CoversClass(RelativeExceptZero::class)]
class RelativeExceptZeroTest extends BaseTestCase
{
    #[TestDox("allows all integer except zero.")]
    public function test_range(): void
    {
        /**
         * $min ≠ 0
         * $max ≠ 0
         */
        // Arrange
        $min = -1;
        $max = +1;
        $validator = new RelativeExceptZero;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-1, $min);
        $this->assertSame(+1, $max);

        /**
         * $min = 0
         * $max ≠ 0
         */
        // Arrange
        $min = 0;
        $max = 7;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-1, $min);
        $this->assertSame(7, $max);

        /**
         * $min ≠ 0
         * $max = 0
         */
        // Arrange
        $min = -3;
        $max = 0;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-3, $min);
        $this->assertSame(1, $max);

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
        $this->assertSame(-1, $min);
        $this->assertSame(+1, $max);
    }
}