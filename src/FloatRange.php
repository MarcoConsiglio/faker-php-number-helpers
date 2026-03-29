<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Float\Validator as FloatValidator;

/**
 * A `float` Range.
 */
class FloatRange
{
    /**
     * The maximum number allowed.
     */
    public const float MAX = PHP_FLOAT_MAX;

    /**
     * The minimum number allowed.
     */
    public const float MIN = -PHP_FLOAT_MAX;

    /**
     * The smallest normal number in floating point.
     */
    public const float MICRO = PHP_FLOAT_MIN;

    /**
     * The maximum `float` value that can still have a fractional part. This 
     * value is based on a 64 bit `float`.
     * 
     * @see https://float.exposed/0x432ffffffffffffe
     */
    public const float MAX_FRACTION = 4503599627370495;

    /**
     * The minimum `float` value that can still have a fractional part. This 
     * value is based on a 64 bit `float`.
     */
    public const float MIN_FRACTION = -self::MAX_FRACTION;

    /**
     * Construct a `FloatRange`.
     * 
     * @param float $start Range start.
     * @param float $end Range end.
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