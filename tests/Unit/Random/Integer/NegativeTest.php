<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Negative;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyNegative;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Negative random integer generator")]
#[CoversClass(Negative::class)]
#[UsesClass(IntRange::class)]
#[UsesClass(OnlyNegative::class)]
#[UsesClass(Validator::class)]
class NegativeTest extends GeneratorTest
{
    #[TestDox("generates a negative integer.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new Negative(
            $this->generator, 
            new IntRange(IntRange::MIN, -1)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertLessThan(0, $number);
    }
}