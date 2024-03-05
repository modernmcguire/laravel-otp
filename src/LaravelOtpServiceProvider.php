<?php

namespace ModernMcGuire\LaravelOtp;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Validated;
use App\Http\Middleware\EncryptCookies;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ModernMcGuire\LaravelOtp\Listeners\RedirectForOtpVerification;

class LaravelOtpServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-otp')
            ->hasConfigFile('laravel-otp')
            ->hasViews('laravel-otp')
            ->hasMigration('add_otp_fields')
            ->hasRoute('laravel-otp');

        // Register the manager
        $this->app->singleton('laravel-otp.manager', function ($app) {
            return new LaravelOtp($app);
        });

        // Hook into the login flow to check if the user needs OTP verification
        $this->app['events']->listen(Validated::class, RedirectForOtpVerification::class);

        // Ignore encryption for the otp_user_id cookie
        $this->app->extend(EncryptCookies::class, function ($middleware, $app) {
            $middleware->disableFor('otp_user_id');
            return $middleware;
        });
    }

    public function packageRegistered()
    {
    }
}
