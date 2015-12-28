<?php

return [
    'disks' => [
        'local' => [
            'root' => storage_path('app/' . env('APP_ENV')),
        ],
    ],
];
