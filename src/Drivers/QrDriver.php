<?php

namespace ModernMcGuire\LaravelOtp\Drivers;

use ModernMcGuire\LaravelOtp\Drivers\DriverContract;

class QrDriver implements DriverContract
{
    public function generateOtp(): string
    {
        return false;
    }

    public function sendOtp($user): bool
    {
        // Send the OTP to the user's phone number
        return false;
    }
}
