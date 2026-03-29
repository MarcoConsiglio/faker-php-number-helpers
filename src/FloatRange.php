<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;

/**
 * A `float` range.
 */
class FloatRange
{
    /**
     * The maximum number allowed.
     * 
     * @var float MAX
     */
    public const float MAX = PHP_FLOAT_MAX;

    /**
     * The minimum number allowed.
     * 
     * @var float MIN
     */
    public const float MIN = -PHP_FLOAT_MAX;

    /**
     * The smallest normal number in floating point.
     * 
     * @var float MICRO
     */
    public const float MICRO = PHP_FLOAT_MIN;

    /**
     * The maximum `float` value that can still have a fractional part. This 
     * value is based on a 64 bit `float`.
     * 
     * @var float MAX_FRACTION
     * @see https://float.exposed/0x432ffffffffffffe
     */
    public const float MAX_FRACTION = 4503599627370495;

    /**
     * The minimum `float` value that can still have a fractional part. This 
     * value is based on a 64 bit `float`.
     * 
     * @var float MIN_FRACTION
     */
    public const float MIN_FRACTION = -self::MAX_FRACTION;

    /**
     * Construct a `FloatRange`.
     */
    public function __construct(
        public protected(set) float $start,
        public protected(set) float $end
    ) {}

    /**
     * Validate this `FloatRange`.
     */
    public function validate(FloatValidator $validator): void
    {
        $validator->validate($this->start, $this->end);
    }
}