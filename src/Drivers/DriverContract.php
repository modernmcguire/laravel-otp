<?php

namespace ModernMcGuire\LaravelOtp\Drivers;

use Illuminate\Contracts\Auth\Authenticatable;

interface DriverContract
{
    public function generateOtp(): string;
    public function sendOtp(Authenticatable $user, string $otp): bool;
}
