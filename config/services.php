<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'whatsapp' => [
        'token' => env('TECNOSPEED_TOKEN'),
        'instance_token' => env('TECNOSPEED_INSTANCE'),
        'base_url' => env('TECNOSPEED_BASE_URL'),
        'send_url' => env('TECNOSPEED_SEND_URL'),
        'enabled' => env('SEND_WHATSAPP', false),
        'security_token' => env('SECURITY_TOKEN', ''),
        'expires_limit' => now()->addMinutes(intval(env('CHAT_EXPIRES_LIMIT', 60)))
    ]

];
