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

    'facebook' => [
        'client_id' => '1244815642289518',
        'client_secret' => 'd734338be40736fe4d9fa8063fda75aa',
        'redirect' => 'http://localhost/lv5_5/login/facebook/callback',
    ],


    'twitter' => [
        'client_id' => '1zfU2EVNGn3mmMiob9Wra6gP9',
        'client_secret' => '21Fk5VpU2T2R0Ffzto682TQVHEojja10lFoc25zGu2imw0xorK',
        'redirect' => 'http://localhost/lv5_5/login/twitter/callback',
    ],

    'google' => [
        'client_id' => '323065456096-3hm2kp6ahhkj7pl7c3eeepd1vkvoepdg.apps.googleusercontent.com',
        'client_secret' => 'MRutSWVviStWoQCNYD1CZWm3',
        'redirect' => 'http://localhost/lv5_5/login/google/callback',
    ],

];
