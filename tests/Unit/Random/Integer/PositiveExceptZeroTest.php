<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\PositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositiveExceptZero;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The PositiveExceptZero random integer generator")]
#[CoversClass(PositiveExceptZero::class)]
#[UsesClass(IntRange::class)]
#[UsesClass(OnlyPositiveExceptZero::class)]
#[UsesClass(Validator::class)]
class PositiveExceptZeroTest extends GeneratorTest
{
    #[TestDox("generates a positive integer except zero.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new PositiveExceptZero(
            $this->generator,
            new IntRange(1, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThan(0, $number);
    }
}