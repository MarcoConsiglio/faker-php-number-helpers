<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Validation\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Relative;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The Relative integer validator")]
#[CoversClass(Relative::class)]
class RelativeTest extends BaseTestCase
{
    #[TestDox("allows all integers.")]
    public function test_range(): void
    {
        /**
         * ∀ $min
         * ∀ $max
         */
        // Arrange
        $min = -3;
        $max = +7;
        $validator = new Relative;

        // Act
        $validator->validate($min, $max);

        // Assert
        $this->assertSame(-3, $min);
        $this->assertSame(7, $max);
    }
}