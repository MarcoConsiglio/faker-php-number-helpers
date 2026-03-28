<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\IntRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\OnlyPositive;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The IntRange")]
#[CoversClass(IntRange::class)]
class IntRangeTest extends BaseTestCase
{
    #[TestDox("can be validated by a validator.")]
    public function test_validation(): void
    {
        // Arrange
        $range = new IntRange(IntRange::MIN, IntRange::MAX);

        // Assert
        $validator_mock = $this->createMock(OnlyPositive::class);
        $validator_mock
            ->expects($this->once())->method("validate");

        // Act
        $range->validate($validator_mock);
    }
}