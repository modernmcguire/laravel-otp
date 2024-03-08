<?php

namespace ModernMcGuire\Drawbridge\Drivers;

class SmsDriver implements DriverContract
{
    public function generateOtp(): string
    {
        $number = mt_rand(0, 999999); // Generate a random number
        $numberWithLeadingZeros = str_pad($number, 6, '0', STR_PAD_LEFT); // Pad with leading zeros

        return $numberWithLeadingZeros; // Outputs: e.g., 000319
    }

    public function sendOtp($user): bool
    {
        // Send the OTP to the user's phone number
        return true;
    }
}
