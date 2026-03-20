![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/faker-php-number-helpers)
![Static Badge](https://img.shields.io/badge/version-v2.0.0-white)
<br>
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Line%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/96%25-rgb(40%2C%20167%2C%2069)?label=Branch%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/84%25-rgb(193%2C148%2C6)?label=Path%20coverage&labelColor=rgb(255%2C255%2C255))

# faker-php-number-helpers
Adds a helper trait that makes it easier to generate random numbers using FakerPHP.

# Installation
Use it as a production dependency
```
composer require marcoconsiglio/faker-php-number-helpers
```
or a development dependency
```
composer require --dev marcoconsiglio/faker-php-number-helpers
```

# Usage

Add the trait to a `TestCase` class if you use this library in your tests project written in PHPUnit, otherwise add it wherever you need it.

```php
<?php
namespace MyCompany\Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;

class MyUnitTestCase extends TestCase
{
    use WithFakerHelpers;

    protected function setUp(): void
    {
        parent::setUp();
        // Set up faker before using the methods in the trait.
        $this->setUpFaker();
    }

    public function test_example(): void
    {
        // Arrange
        $int = $this->randomInteger(); // 45465
        $float = $this->randomFloat(); // 89354.454687684
    }
}
```

## Integer generation
| Method | Minimum | Maximum | Excluded |
| ---: | :---: | :---: | :---: |
| randomInteger() | PHP_INT_MIN | PHP_INT_MAX |  |
| positiveRandomInteger() | 0 | PHP_INT_MAX |  |
| negativeRandomInteger() | PHP_INT_MIN + 1 | -1 | 0 |
| nonZeroRandomInteger() | PHP_INT_MIN + 1 | PHP_INT_MAX | 0 |
| positiveNonZeroRandomInteger() | 1 | PHP_INT_MAX | 0 |
| negativeNonZeroRandomInteger() | PHP_INT_MIN + 1 | -1 | 0 |

## Float generation
| Method | Minimum | Maximum | Excluded |
| ---: | :---: | :---: | :---: |
| randomFloat() | -PHP_FLOAT_MAX | PHP_FLOAT_MAX |  |
| positiveRandomFloat() | 0 | PHP_FLOAT_MAX |  |
| negativeRandomFloat() | -PHP_FLOAT_MAX | 0 | 0 |
| nonZeroRandomFloat() | -PHP_FLOAT_MAX | PHP_FLOAT_MAX | 0 |
| positiveNonZeroRandomFloat() | 0 | PHP_FLOAT_MAX | 0 |
| negativeNonZeroRandomFloat() | -PHP_FLOAT_MAX | 0 | 0 |
| randomFloatStrict() | -self::STRICT_FLOAT_MAX | self::STRICT_FLOAT_MAX | integer `float`s |
| positiveRandomFloatStrict() | 0 | self::STRICT_FLOAT_MAX | integer `float`s |
| negativeRandomFloatStrict() | -self::STRICT_FLOAT_MAX | 0 | integer `float`s |

# API Documentation
See more in the API Documentation for more helpers at `./docs/html/index.html`.