# Changelog
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