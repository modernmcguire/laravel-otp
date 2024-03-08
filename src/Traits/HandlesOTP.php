<?php

namespace ModernMcGuire\Drawbridge\Traits;

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
        app('drawbridge.manager')->generateAndSendOtp($this);
    }

    public function validateOTP($otp): bool
    {
        return app('drawbridge.manager')->validateOtp($this, $otp);
    }
}
