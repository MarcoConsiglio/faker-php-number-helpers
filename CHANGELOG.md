# Changelog
## v4.2.1 2026-04-04
### Changed
- Minor code edits.
- Rector configuration.

## v4.2.0 2026-04-01
### Added
- `Validator::{`  
&ensp;&ensp;&ensp;&ensp;`different`,  
&ensp;&ensp;&ensp;&ensp;`greaterThanOrEqual`,  
&ensp;&ensp;&ensp;&ensp;`greaterThan`,  
&ensp;&ensp;&ensp;&ensp;`lessThan`,  
`}` methods
### Changed
- All `Validator` abstract class visibility methods to `public`.
- `Validator::areBothEqual()` method name to `equal()`.
- API documentation.

## v4.1.1 2026-04-01
### Changed
- API documentation.

## v4.1.0 2026-03-31
### Added
- `NextFloat` class to calculate the previous/next representable `float` number near another `float` number.
### Deprecated
- `FloatRange::MICRO` constant.
### Changed
- API and README documentation.

## v4.0.0 2026-03-30
### Added
- Default `$locale` parameter of the `WithFakerHelpers::setUpFaker()` method.
- `IntRange` class to represent an `int` range.
- `FloatRange` class to represent a `float` range.
### Changed
- All methods and properties of `WithFakerHelpers` trait are now declared as `static`.
- Renamed `WithFakerHelpers::randomFloatStrict()` method to `WithFakerHelpers::randomFraction()`.
- Renamed `WithFakerHelpers::positiveRandomFloatStrict()` method to `WithFakerHelpers::positiveRandomFraction()`.
- Renamed `WithFakerHelpers::negativeRandomFloatStrict()` method to `WithFakerHelpers::negativeRandomFraction()`.
### Removed
- `WithStaticFakerHelpers` trait, use `WithFakerHelpers` instead.
### Fixed
- Bug [#7](https://github.com/MarcoConsiglio/faker-php-number-helpers/issues/7): *Infinite loop in nonZeroRandomInteger() method*.

## v3.1.0 2026-03-22
### Added
- `WithStaticFakerHelpers` trait to use FakerPHP inside static methods.

## v3.0.0 2026-03-20
### Added
- `WithFakerHelpers::STRICT_FLOAT_MAX` constant to ensure strict `float` generation limits with a fractional part.
### Changed
- `WithFakerHelpers::randomInteger()` `$min` parameter default value from `0` to `PHP_INT_MIN`.
- `WithFakerHelpers::negativeRandomInteger()` `$min` parameter default value from `1` to `PHP_INT_MIN + 1` and `$max` parameter default value from `PHP_INT_MAX` to `-1`.
- `WithFakerHelpers::negativeNonZeroRandomInteger()` `$min` parameter default value from `1` to `PHP_INT_MIN + 1` and `$max` parameter default value from `PHP_INT_MAX` to `-1`.
- `WithFakerHelpers::nonZeroRandomInteger()` `$min` parameter default value from `0` to `PHP_INT_MIN + 1`.
- `WithFakerHelpers::randomFloat()` `$min` parameter default value from `0` to `-PHP_FLOAT_MAX`.
- `WithFakerHelpers::negativeRandomFloat()` `$min` parameter default value from `0` to `-PHP_FLOAT_MAX` and `$max` parameter default value from `PHP_FLOAT_MAX` to `0`.
- `WithFakerHelpers::randomFloatStrict()` `$min` parameter default value from `0` to `-self::STRICT_FLOAT_MAX` and `$max` parameter default value from `PHP_FLOAT_MAX` to `self::STRICT_FLOAT_MAX`.
- `WithFakerHelpers::positiveRandomFloatStrict()` `$max` parameter default value from `PHP_FLOAT_MAX` to `self::STRICT_FLOAT_MAX`.
- `WithFakerHelpers::negativeRandomFloatStrict()` `$min` parameter default value from `0` to `-self::STRICT_FLOAT_MAX` and `$max` parameter default value from `PHP_FLOAT_MAX` to `0`.
- `WithFakerHelpers::negativeNonZeroRandomFloat()` `$min` parameter default value from `0` to `-PHP_FLOAT_MAX` and `$max` parameter default value from `PHP_FLOAT_MAX` to `0`.
- `WithFakerHelpers::nonZeroRandomFloat()` `$min` parameter default value from `0` to `-PHP_FLOAT_MAX`.

## v2.0.0 2026-02-25
### Changed
- Changed all methods and properties in `WithFakerHelpers` trait from static to non-static.
- API documentation.

## v1.1.0 2026-02-23
### Changed
- `WithFakerHelpers::{`  
&ensp;&ensp;&ensp;&ensp;`randomInteger`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`nonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`positiveNonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`negativeNonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`randomFloat`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`randomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`nonZeroRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`negativeNonZeroRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`positiveNonZeroRandomFloat`  
`}()` methods now have the possibility to take as input the number of decimal places.
- API and README documentation.

## v1.0.0 2026-02-20
### Added
- `WithFakerHelpers` trait.
- `WithFakerHelpers::{`  
&ensp;&ensp;&ensp;&ensp;`randomInteger`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`nonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`positiveNonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`negativeNonZeroRandomInteger`  
&ensp;&ensp;&ensp;&ensp;`randomFloat`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`randomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`positiveRandomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`negativeRandomFloatStrict`  
&ensp;&ensp;&ensp;&ensp;`nonZeroRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`negativeNonZeroRandomFloat`  
&ensp;&ensp;&ensp;&ensp;`positiveNonZeroRandomFloat`  
`}()` methods