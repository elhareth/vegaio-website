<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        /**
         *
         * ADDITIONS
         *
         */
        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST', null),
            'username' => env('FTP_USERNAME', null),
            'password' => env('FTP_PASSWORD', null),

            // Optional FTP Settings...
            // 'port' => 21,
            // 'root' => '',
            // 'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 30,
        ],

        'sftp' => [
            'driver' => 'sftp',
            'host' => env('SFTP_HOST', null),
            'username' => env('SFTP_USERNAME', null),
            'password' => env('SFTP_PASSWORD', null),

            // Settings for SSH key based authentication...
            // 'privateKey' => '/path/to/privateKey',
            // 'password' => 'encryption-password',

            // Optional SFTP Settings...
            // 'port' => 22,
            // 'root' => '',
            // 'timeout' => 30,
        ],

        'media' => [
            'driver'         => 'local',
            'root'          => storage_path('app/media'),
            'url'           => env('APP_URL') . '/media',
            'visibility'    => 'public',
            'throw'         => true,
        ],

        'static' => [
            'driver'         => 'local',
            'root'          => storage_path('app/static'),
            'url'           => env('APP_URL') . '/static',
            'visibility'    => 'private',
            'throw'         => true,
        ],

        'uploads' => [
            'driver'         => 'local',
            'root'          => storage_path('app/uploads'),
            'url'           => env('APP_URL') . '/uploads',
            'visibility'    => 'public',
            'throw'         => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('media')    => storage_path('app/media'),
        public_path('storage')  => storage_path('app/public'),
        public_path('static')   => storage_path('app/static'),
        public_path('uploads')  => storage_path('app/uploads'),
        public_path('purifier') => storage_path('app/purifier'),
    ],

];
