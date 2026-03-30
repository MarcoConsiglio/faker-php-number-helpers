<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Tests;

use Faker\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RoundingMode;

abstract class BaseTestCase extends TestCase
{
    /**
     * FakerPHP instance.
     */
    protected static Generator $faker;

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

    /**
     * Replace the `Faker\Generator` implementetion with one that return `true`
     * every time the `$boolean()` property is called.
     */
    protected function trickFakerToGetTrueOut(): Generator&MockObject
    {
        $builder = $this->getMockBuilder(Generator::class);
        $builder->onlyMethods(["__call"]);
        $faker_mock = $builder->getMock();
        $faker_mock->expects($this->atLeastOnce())->method("__call")->with("boolean")->willReturn(true);
        return $faker_mock;
    }

    /**
     * Replace the `Faker\Generator` implementetion with one that return `false`
     * every time the `$boolean()` property is called.
     */
    protected function trickFakerToGetFalseOut(): Generator&MockObject
    {
        $builder = $this->getMockBuilder(Generator::class);
        $builder->onlyMethods(["__call"]);
        $faker_mock = $builder->getMock();
        $faker_mock->expects($this->atLeastOnce())->method("__call")->with("boolean")->willReturn(false);
        return $faker_mock;
    }
}