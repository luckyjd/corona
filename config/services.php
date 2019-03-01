<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'GOOGLE_MAP_API_KEY' => '',

    // laravel socialite ~ facebook, google, twitter, linkedin, github or bitbucket
    'facebook' => [
        'client_id' => env('SOCIALITE_FACEBOOK_CLIENT_ID', null),
        'client_secret' => env('SOCIALITE_FACEBOOK_CLIENT_SECRET', null),
        'redirect' => env('SOCIALITE_FACEBOOK_REDIRECT', 'callback'),
    ],
    'google' => [
        'client_id' => env('SOCIALITE_GOOGLE_CLIENT_ID', null),
        'client_secret' => env('SOCIALITE_GOOGLE_CLIENT_SECRET', null),
        'redirect' => env('SOCIALITE_GOOGLE_REDIRECT', 'callback'),
    ],
    'twitter' => [
        'client_id' => env('SOCIALITE_TWITTER_CLIENT_ID', null),
        'client_secret' => env('SOCIALITE_TWITTER_CLIENT_SECRET', null),
        'redirect' => env('SOCIALITE_TWITTER_REDIRECT', 'callback'),
    ],
];
