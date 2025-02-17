<?php

return [
    'guards' => [
        'masyarakat' => [
            'driver' => 'session',
            'provider' => 'masyarakat',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],

    'providers' => [
        'masyarakat' => [
            'driver' => 'eloquent',
            'model' => App\Models\Masyarakat::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],
    ],

];
