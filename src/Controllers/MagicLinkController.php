<?php

namespace ModernMcGuire\LaravelOtp\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use ModernMcGuire\LaravelOtp\Mail\SendMagicLinkMail;

class MagicLinkController extends Controller
{
    public function store(Request $request)
    {
        // create the email to the user
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }

        $url = URL::temporarySignedRoute(
            'magic-login-verify',
            now()->addMinutes(30),
            ['email' => $request->email]
        );

        Mail::to($user)->send(new SendMagicLinkMail($url));

        return response('', 200);
    }

    public function show(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
