<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default notification driver
    |--------------------------------------------------------------------------
    | 
    | Đặt driver mặc định cho thông báo. Ở đây mình để là "toastr".
    |
    */
    'default' => 'toastr',

    /*
    |--------------------------------------------------------------------------
    | Auto render
    |--------------------------------------------------------------------------
    |
    | Nếu để true, Flasher sẽ tự inject /vendor/flasher/flasher.min.js (gây lỗi 404).
    | Đặt false để tự quản lý bằng local assets.
    |
    */
    'auto_render' => false,

    /*
    |--------------------------------------------------------------------------
    | Drivers configuration
    |--------------------------------------------------------------------------
    |
    | Cấu hình các driver hỗ trợ. Ở đây mình chỉ giữ toastr.
    |
    */
    'toastr' => [
        'scripts' => [
            // jQuery
            'https://code.jquery.com/jquery-3.6.0.min.js',
            // Toastr JS
            'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
            // Flasher core JS từ CDN
            'https://cdn.jsdelivr.net/npm/@flasher/flasher/dist/flasher.min.js',
        ],
        'styles' => [
            // Toastr CSS
            'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
        ],
        'options' => [
            'closeButton' => true,
            'progressBar' => true,
            'timeOut' => 5000,
            'extendedTimeOut' => 2000,
            'positionClass' => 'toast-top-right',
        ],
    ],

];
