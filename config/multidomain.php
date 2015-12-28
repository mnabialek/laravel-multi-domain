<?php

return [
    'paths' => [
        'bootstrap_cache' => base_path('bootstrap/cache/{env}'),
        'logs' => base_path('storage/logs/{env}'),
        'database' => base_path('database'),
        'lang' => base_path('resources/lang'),
        
        // this is NOT recommended to be changed - if you want to change it
        // to include environment in path - you will need to create the whole
        // directory structure (app, framework, cache etc)
        'storage' => base_path('storage'),
    ],
];
