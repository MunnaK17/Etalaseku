<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk payment gateway Midtrans
    |
    */

    'merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    // Environment: sandbox atau production
    'environment' => env('MIDTRANS_ENVIRONMENT', 'sandbox'),

    // Snap URL (untuk tampilan popup)
    'snap_url' => env('MIDTRANS_ENVIRONMENT', 'sandbox') === 'production'
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js',

    // Core API URL
    'core_api_url' => env('MIDTRANS_ENVIRONMENT', 'sandbox') === 'production'
        ? 'https://api.midtrans.com'
        : 'https://api.sandbox.midtrans.com',

    // Snap Redirect URL
    'snap_redirect_url' => env('MIDTRANS_ENVIRONMENT', 'sandbox') === 'production'
        ? 'https://app.midtrans.com/snap/v2/redirection'
        : 'https://app.sandbox.midtrans.com/snap/v2/redirection',
];
