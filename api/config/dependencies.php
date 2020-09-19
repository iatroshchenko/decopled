<?php

declare(strict_types=1);

$common = glob(__DIR__ . '/common/*.php') ?: [];
$env = getenv('APP_ENV') ?: 'prod';
$environment = glob(__DIR__ . '/' . $env . '/*.php') ?: [];

$files = array_merge(
    $common,
    $environment
);

$configs = array_map(
    function (string $file): array {
        /**
         * @var array
         * @noinspection PhpIncludeInspection
         * @psalm-suppress UnresolvableInclude
         */
        return require $file;
    },
    $files
);

/*
 * Structure will be like: [ [ common conf ] [ env-specific conf ] ]
 * Then we run array_merge_recursive and env-specific will replace common
 *  */
return array_merge_recursive(...$configs);
