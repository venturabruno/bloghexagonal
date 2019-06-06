<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ConfigAggregator;
use Psr\Cache\CacheItemPoolInterface;

return [
    // Toggle the configuration cache. Set this to boolean false, or remove the
    // directive, to disable configuration caching. Toggling development mode
    // will also disable it by default; clear the configuration cache using
    // `composer clear-config-cache`.
    ConfigAggregator::ENABLE_CACHE => true,

    // Enable debugging; typically used to provide debugging information within templates.
    'debug' => false,

    'zend-expressive' => [
        // Provide templates for the error handling middleware to use when
        // generating responses.
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],

    'zend-expressive-session-cache' => [
        'cache_item_pool_service' => CacheItemPoolInterface::class,
        'cookie_name'             => 'PHPSESSION',
        'cookie_path'             => '/',
        'cache_limiter'           => 'nocache',
        'cache_expire'            => 10800,
        'last_modified'           => null,
    ],
];
