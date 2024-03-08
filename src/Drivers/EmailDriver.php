<?php

namespace ModernMcGuire\Drawbridge\Drivers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\Authenticatable;
use ModernMcGuire\Drawbridge\Mail\SendOTPMail;

class EmailDriver implements DriverContract
{
    public function generateOtp(): string
    {
        $number = mt_rand(0, 999999); // Generate a random number
        $numberWithLeadingZeros = str_pad($number, 6, '0', STR_PAD_LEFT); // Pad with leading zeros

        return $numberWithLeadingZeros; // Outputs: e.g., 000319
    }

    public function sendOtp(Authenticatable $user, string $otp): bool
    {
        $mailable = config('drawbridge.drivers.email.mailable_class', SendOTPMail::class);

        Mail::to($user->getEmailForOtp())->send(new $mailable($otp));

        return true;
    }
}
