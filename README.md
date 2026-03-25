![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/faker-php-number-helpers)
![GitHub Release](https://img.shields.io/github/v/release/MarcoConsiglio/faker-php-number-helpers)
![Static Badge](https://img.shields.io/badge/version-v3.1.0-white)
<br>
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Line%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/96%25-rgb(40%2C%20167%2C%2069)?label=Branch%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/84%25-rgb(193%2C148%2C6)?label=Path%20coverage&labelColor=rgb(255%2C255%2C255))

# faker-php-number-helpers
Adds a helper trait that makes it easier to generate random numbers using FakerPHP.

# Index
- [Installation](#installation)
- [Usage](#usage)
- [Available methods](#available-methods)
  - [Integer generation](#integer-generation)
  - [Float generation](#float-generation)
- [API Documentation](#api-documentation)


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

use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use PHPUnit\Framework\TestCase;

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

In some tests, you'll need a PHPUnit data provider, which is a static function. In this case you can use call statically `setUpFaker()` method in order to set up a static `Faker\Generator` when PHPUnit call the data provider method, which is done prior to call a `setUp()` method.

```php
<?php
namespace MyCompany\Project\Tests\Unit;

use MarcoConsiglio\FakerPhpNumberHelpers\WithStaticFakerHelpers;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MyUnitTestCase extends TestCase
{
    use WithStaticFakerHelpers;

    /**
     * This won't work as this method is called after
     * myDataProvider().
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker(); // Too late!
    }

    public static function myDataProvider(): array
    {
        self::setUpFaker(); // Early call!
        return [
            [self::randomInteger()]
        ];
    }
    
    #[DataProvider("myDataProvider")]
    public function test_something(int $number): void
    {
        // Act & Assert
        $this->assertIsInt($number);
    }
}
```
# Constants
Several constants provide the limit for random generation.
## Integer
| Constant | Value |
| :---: | :---: |
| `IntRange::MIN` | `PHP_INT_MIN + 1` |
| `IntRange::MAX` | `PHP_INT_MAX` |
| `FloatRange::MIN` | `-PHP_FLOAT_MAX` |
| `FloatRange::MAX` | `PHP_FLOAT_MAX` |
| `FloatRange::MICRO` | `PHP_FLOAT_MIN` |
| `FloatRange::MAX_FRACTION` | 4,503,599,627,370,495.0 |
| `FloatRange::MIN_FRACTION` | -4,503,599,627,370,495.0 |

# Available methods
## Integer generation
| Method | Minimum | Maximum | Excluded |
| ---: | :---: | :---: | :---: |
| `randomInteger()` | `PHP_INT_MIN` | `PHP_INT_MAX` |  |
| `positiveRandomInteger()` | 0 | `PHP_INT_MAX` |  |
| `negativeRandomInteger()` | `PHP_INT_MIN` + 1 | -1 | 0 |
| `nonZeroRandomInteger()` | `PHP_INT_MIN` + 1 | `PHP_INT_MAX` | 0 |
| `positiveNonZeroRandomInteger()` | 1 | `PHP_INT_MAX` | 0 |
| `negativeNonZeroRandomInteger()` | `PHP_INT_MIN` + 1 | -1 | 0 |

## Float generation
| Method | Minimum | Maximum | Excluded |
| -----: | :-----: | :-----: | :------: |
| `randomFloat()` | `-PHP_FLOAT_MAX` | `PHP_FLOAT_MAX` |  |
| `positiveRandomFloat()` | 0 | `PHP_FLOAT_MAX` |  |
| `negativeRandomFloat()` | `-PHP_FLOAT_MAX` | 0 | 0 |
| `nonZeroRandomFloat()` | `-PHP_FLOAT_MAX` | `PHP_FLOAT_MAX` | 0 |
| `positiveNonZeroRandomFloat()` | `PHP_FLOAT_MIN` | `PHP_FLOAT_MAX` | 0 |
| `negativeNonZeroRandomFloat()` | `-PHP_FLOAT_MAX` | `-PHP_FLOAT_MIN` | 0 |
| `randomFraction()` | `-FloatRange::MAX_FRACTION` | `FloatRange::MAX_FRACTION` | integer `float`s |
| `positiveRandomFraction()` | `PHP_FLOAT_MIN` | `FloatRange::MAX_FRACTION` | integer `float`s |
| `negativeRandomFraction()` | `-FloatRange::MAX_FRACTION` | `-PHP_FLOAT_MIN` | integer `float`s |

# API Documentation
See more in the API Documentation at `./docs/html/index.html`.