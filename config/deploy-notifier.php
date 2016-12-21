<?php

return [
    'settings' => [
        'environment' => env('APP_ENV', 'staging'),
        'notifier'    => env('DEPLOY_NOTIFIER', 'hipchat'),
        'color'       => env('DEPLOY_NOTIFIER_COLOR', 'gray'),
        'sender'      => env('DEPLOY_NOTIFIER_SENDER', 'I\'am unnamed :('),
    ],

    'notifiers' => [
        'hipchat' => [
            'room_id'    => env('DEPLOY_NOTIFIER_HIPCHAT_ROOM_ID'),
            'room_token' => env('DEPLOY_NOTIFIER_HIPCHAT_ROOM_TOKEN'),
        ],
    ],
];
