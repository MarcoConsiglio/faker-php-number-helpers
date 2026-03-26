<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\Integer;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Random\Integer\Positive;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit\Random\GeneratorTest;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator as IntegerValidator;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Positive random integer generator")]
#[CoversClass(Positive::class)]
#[UsesClass(IntRange::class)]
#[UsesClass(OnlyPositive::class)]
#[UsesClass(IntegerValidator::class)]
#[UsesClass(Validator::class)]
class PositiveTest extends GeneratorTest
{
    #[TestDox("generates a positive integer.")]
    public function test_random_generation(): void
    {
        // Arrange
        $generator = new Positive(
            $this->generator,
            new IntRange(0, IntRange::MAX)
        );

        // Act
        $number = $generator->generate();

        // Assert
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(0, $number);
    }
}