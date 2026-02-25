![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/faker-php-number-helpers)
![Static Badge](https://img.shields.io/badge/version-v2.0.0-white)
<br>
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Line%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/91%25-rgb(40%2C%20167%2C%2069)?label=Branch%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/61%25-rgb(193%2C148%2C6)?label=Path%20coverage&labelColor=rgb(255%2C255%2C255))

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

    ...
}
```

## Examples
```php
$number_1 = $this->negativeRandomFloatStrict(min: 10.0, max: 30.0, precision: 4); // (float) -14.5346
$number_2 = $this->nonZeroPositiveInteger(max: 10); // (int) 3
```

# API Documentation
See more in the API Documentation for more helpers at `./docs/html/index.html`.