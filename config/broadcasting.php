<?php

return [
    'default' => env('BROADCAST_DRIVER', 'pusher'),

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'host' => env('PUSHER_HOST', 'api.pusher.com'),
                'port' => env('PUSHER_PORT', 443),
                'scheme' => env('PUSHER_SCHEME', 'https'),
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true,
            ],
        ],
    ],
];
