<?php

return [
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),
    'Error' => [
        'errorLevel' => E_ALL,
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],
    'DebugKit' => [
        'forceEnable' => false,
        'panels' => true,
    ],
    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'en_US'),
        'defaultTimezone' => env('APP_DEFAULT_TIMEZONE', 'Australia/Sydney'),
        'base' => env('APP_BASE', '/'),
        'dir' => 'src',
        'webroot' => 'webroot',
        'fullBaseUrl' => env('FULL_BASE_URL', ''),
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [ROOT . DS . 'templates' . DS],
        ],
    ],
    'Security' => [
        'salt' => env('SECURITY_SALT', '__CHANGE_THIS_SALT_IN_PRODUCTION__'),
    ],
    'Session' => [
        'defaults' => 'php',
        'cookie' => 'cwsaus',
        'timeout' => 4320,
        'cookiePath' => '/',
    ],
    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
            'url' => env('CACHE_DEFAULT_URL', null),
        ],
        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+2 minutes',
            'url' => env('CACHE_CAKECORE_URL', null),
        ],
        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+2 minutes',
            'url' => env('CACHE_CAKEMODEL_URL', null),
        ],
    ],
];
