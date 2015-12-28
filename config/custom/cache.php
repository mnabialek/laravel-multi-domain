<?php

return [
    'file' => [
        'driver' => 'file',
        'path' => storage_path('framework/cache/' . env('APP_ENV')),
    ],

    'prefix' => env('CACHE_PREFIX', env('APP_ENV')),
];
