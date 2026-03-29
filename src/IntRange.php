<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers;

use MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer\Validator as IntegerValidator;

/**
 * An integer Range.
 */
class IntRange
{
    /**
     * The maximum number allowed.
     */
    public const int MAX = PHP_INT_MAX;

    /**
     * The minimum number allowed.
     */
    public const int MIN = PHP_INT_MIN + 1;

    /**
     * Construct an `IntRange`.
     * 
     * @param int $start Range start.
     * @param int $end Range end.
     */
    public function __construct(
        public protected(set) int $start,
        public protected(set) int $end
    ) {}

    /**
     * Validate this `IntRange`.
     */
    public function validate(IntegerValidator $validator): void
    {
        $validator->validate($this->start, $this->end);
    }
}