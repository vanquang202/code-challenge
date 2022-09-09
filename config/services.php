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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        // 'client_id' => "492481953658-8a6u276retmmenb2i7btoaangvkonbv1.apps.googleusercontent.com",
        // 'client_secret' => "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",
        // 'redirect' => "http://127.0.0.1:8000/auth/google/callback",
        'client_id' => "492481953658-iob89kmo8rb87hb8th7q7ciassb21jbj.apps.googleusercontent.com",
        'client_secret' => "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",
        'redirect' => "https://api.laravel.org/api/callback",
    ],
];