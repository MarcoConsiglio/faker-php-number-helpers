<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\If_\CompleteMissingIfElseBracketRector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withTypeCoverageLevel(63)
    ->withDeadCodeLevel(59)
    ->withCodeQualityLevel(78)
    ->withSkip([
        CompleteMissingIfElseBracketRector::class,
        CompleteDynamicPropertiesRector::class,
        UseIdenticalOverEqualWithSameTypeRector::class => [
            __DIR__ . '/src/Validation/Validator.php'
        ]
    ]);
