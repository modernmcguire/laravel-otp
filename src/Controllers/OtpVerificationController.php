<?php

namespace ModernMcGuire\Drawbridge\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OtpVerificationController extends Controller
{
    public function show()
    {
        return view('drawbridge::show');
    }

    public function verify(Request $request)
    {
        // find user from cookie
        $user = User::findOrFail($this->getUserId());

        // Verify the OTP from the request
        $isValid = $this->verifyOtp($user, $request->otp);

        if (! $isValid) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        Auth::loginUsingId($this->getUserId());

        // remove cookie
        Cookie::queue(Cookie::forget('otp_user_id'));

        // cleanup
        $user->otp_secret = null;
        $user->otp_secret_expires_at = null;
        $user->save();

        return redirect()->intended(RouteServiceProvider::HOME); // Or wherever you want to redirect
    }

    public function resend()
    {
        // find user from cookie
        $user = User::findOrFail($this->getUserId());

        // Resend the OTP to the user
        $user->sendOTP();

        return back()->with('resent', true);
    }

    protected function verifyOtp($user, $otp)
    {
        try {
            // Check to see that the code matches and it's not expired
            return decrypt($user->otp_secret) === $otp && Carbon::parse($user->otp_secret_expires_at)->gt(now());
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function getUserId()
    {
        return decrypt(request()->cookie('otp_user_id'));
    }
}
