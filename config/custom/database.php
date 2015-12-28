<?php

return [
    'connections' => [
        'sqlite' => [
            'database' => database_path(env('APP_ENV') . '/database.sqlite'),
        ],
    ],
];
