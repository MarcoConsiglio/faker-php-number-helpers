<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\FloatRange;
use MarcoConsiglio\FakerPhpNumberHelpers\Tests\BaseTestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\OnlyPositive;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FloatRange::class)]
class FloatRangeTest extends BaseTestCase
{
    public function test_validation(): void
    {
        // Arrange
        $range = new FloatRange(FloatRange::MIN, FloatRange::MAX);

        // Assert
        $validator_mock = $this->createMock(OnlyPositive::class);
        $validator_mock
            ->expects($this->once())
            ->method("validate");

        // Act
        $range->validate($validator_mock);

        // Assert
        
    }
}