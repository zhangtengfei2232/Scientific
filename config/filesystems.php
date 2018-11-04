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

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'agreement' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/agreement'),
        ],
        'appraisal' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/appraisal'),
        ],
        'artical' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/artical'),
        ],
        'award' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/award'),
        ],
        'holdmeet' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/holdmeet'),
        ],
        'duties' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/duties'),
        ],
        'lecture' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/lecture'),
        ],
        'joinmeet' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/joinmeet'),
        ],
        'opus' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/opus'),
        ],
        'patent' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/patent'),
        ],
        'project' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/project'),
        ],
        'teacher' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/teacher'),
        ],
        'schoolfile' => [
            'driver' => 'local',
            'root'   => storage_path('app/data/schoolfile'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
