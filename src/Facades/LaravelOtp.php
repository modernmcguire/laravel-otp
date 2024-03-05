<?php

namespace ModernMcGuire\LaravelOtp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ModernMcGuire\LaravelOtp\LaravelOtp
 */
class LaravelOtp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ModernMcGuire\LaravelOtp\LaravelOtp::class;
    }
}
