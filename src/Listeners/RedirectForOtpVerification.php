<?php

namespace ModernMcGuire\Drawbridge\Listeners;

use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectForOtpVerification
{
    public function handle(Validated $event)
    {
        // Check if the user needs OTP verification
        if ($this->needsOtpVerification($event->user)) {

            // send OTP to the user
            $event->user->sendOTP();

            // log the user out to prevent access to the application
            Auth::logout();

            // Redirect to the OTP verification page
            Redirect::route('otp.verify')
                ->withCookie(cookie('otp_user_id', encrypt($event->user->getKey()), config('drawbridge.otp_expiry')))
                ->send();
        }
    }

    protected function needsOtpVerification($user): bool
    {
        return $user->two_factor_enabled == true;
    }
}
