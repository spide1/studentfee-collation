<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'students',
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [

        'student' => [
            'driver'   => 'session',
            'provider' => 'students',
        ],

        'institute' => [
            'driver'   => 'session',
            'provider' => 'institutes',
        ],

        'admin' => [
            'driver'   => 'session',
            'provider' => 'admins',
        ],

        'parent' => [
            'driver'   => 'session',
            'provider' => 'parents',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [

        'students' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Student::class,
        ],

        'institutes' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Institute::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Admin::class,
        ],

        'parents' => [
            'driver' => 'eloquent',
            'model'  => App\Models\ParentUser::class,
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'students' => [
            'provider' => 'students',
            'table' => 'password_reset_tokens',
            'expire' => 60,
        ],
    ],
];
