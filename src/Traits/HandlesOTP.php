<?php

namespace ModernMcGuire\LaravelOtp\Traits;

trait HandlesOTP
{
    public function getEmailForOtp(): string
    {
        return $this->email;
    }

    public function getPhoneForOtp(): string
    {
        return $this->phone;
    }

    public function sendOTP(): void
    {
        app('laravel-otp.manager')->generateAndSendOtp($this);
    }

    public function validateOTP($otp): bool
    {
        return app('laravel-otp.manager')->validateOtp($this, $otp);
    }
}
