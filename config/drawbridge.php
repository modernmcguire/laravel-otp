<?php

use ModernMcGuire\Drawbridge\Mail\SendOTPMail;

return [
    /**
     * The driver to use for sending the OTP
     * Supported: "email"
     * Default: "email"
     */
    'default_driver' => env('OTP_DRIVER', 'email'),

    'drivers' => [
        'email' => [
            'mailable_class' => SendOTPMail::class,
        ],
    ],

    /**
     * The amount of minutes the OTP is valid for
     * Default: 5
     */
    'otp_expiry' => env('OTP_EXPIRY', 5),
];
