<?php

return [
    'default' => env('DB_CONNECTION', 'mongodb'),
    'connections' => [
        'mongodb' => [
            'driver'   => 'mongodb',
            'dsn'      => env('MONGODB_URI', ''),
            'host'     => env('DB_HOST', '127.0.0.1'),
            'port'     => env('DB_PORT', 27017),
            'database' => env('DB_DATABASE', 'event_manager'),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),
            'options'  => [ 'database' => env('DB_AUTHENTICATION_DATABASE', 'admin') ],
        ],
    ],
];
