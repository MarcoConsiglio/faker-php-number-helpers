<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests;

use PHPUnit\Framework\TestCase;
use RoundingMode;

abstract class BaseTestCase extends TestCase
{
    /**
     * Assert `$actual` is between `$min` and `$max`. This is a Custom Assertion.
     */
    protected function assertInRange(int|float $min, int|float $max, int|float $actual): void
    {
        $this->assertGreaterThanOrEqual($min, $actual);
        $this->assertLessThanOrEqual($max, $actual);
    }

    /**
     * Assert `$actual` is between `$min` and `$max` excluded `$min`. This is a Custom Assertion.
     */
    protected function assertInRangeMinExcluded(int|float $min, int|float $max, int|float $actual): void
    {
        $this->assertGreaterThan($min, $actual);
        $this->assertLessThanOrEqual($max, $actual);
    }

    /**
     * Assert `$actual` is between `$min` and `$max` excluded `$max`. This is a Custom Assertion.
     */
    protected function assertInRangeMaxExcluded(int|float $min, int|float $max, int|float $actual): void
    {
        $this->assertGreaterThanOrEqual($min, $actual);
        $this->assertLessThan($max, $actual);
    }

    /**
     * Assert `$actual` is between `$min` and `$max` both excluded. This is a Custom Assertion.
     */
    protected function assertInRangeBothExcluded(int|float $min, int|float $max, int|float $actual): void
    {
        $this->assertGreaterThan($min, $actual);
        $this->assertLessThan($max, $actual);
    }

    /**
     * Assert `$actual` is a fraction.
     */
    protected function assertIsFraction(float $actual): void
    {
        $this->assertNotEquals(round($actual, 0, RoundingMode::HalfTowardsZero), $actual);
    }
}