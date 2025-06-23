<?php

// config for Strucura/TrailWatch
return [
    'logging' => [
        // Enable or disable logging globally
        'enabled' => true,

        // Exclude specific routes from being logged
        'exclude' => [
            // Exclude by route name
            'names' => [
                'login',
                'register',
            ],

            // Exclude by path (supports wildcards)
            'paths' => [
                'admin/*', // Exclude all routes under 'admin'
                'api/internal/*', // Exclude internal API routes
            ],
        ],

        // Additional logging options
        'log_user' => true, // Log user information if available
        'log_ip' => true,   // Log IP address
        'log_user_agent' => true, // Log user agent
    ],
];
