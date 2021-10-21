<?php
/*
 * Paypal Config And Settings
 */

return [
    // sandbox
    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET'),
    // live
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
    'live_secret' => env('PAYPAL_LIVE_SECRET'),

    'settings' => [
        // Mode => Live Or Sandbox
        'mode' => env('PAYPAL_MODE','sandbox'),
        //Connection Time Out
        'http.ConnectionTimeOut' => 3000,
        //Logs
        'log.LongEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        //level => DEBUG , INFO ,ERROR ,WARN
        'log.logLevel' => 'DEBUG',
    ],

];
