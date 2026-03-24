<?php
namespace MarcoConsiglio\FakerPhpNumberHelpers\Validation\Integer;

class Relative extends Validator
{
    public function validate(int &$min, int &$max): void
    {
        if ($min === PHP_INT_MIN) $min += 1;
        $this->swap($min, $max);
    }
}