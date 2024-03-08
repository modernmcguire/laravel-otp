<?php

namespace ModernMcGuire\Drawbridge;

use App\Http\Middleware\EncryptCookies;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Validated;
use ModernMcGuire\Drawbridge\Listeners\RedirectForOtpVerification;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DrawbridgeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('drawbridge')
            ->hasConfigFile('drawbridge')
            ->hasViews('drawbridge')
            ->hasMigration('add_otp_fields')
            ->hasRoute('drawbridge');

        // Register the manager
        $this->app->singleton('drawbridge.manager', function ($app) {
            return new Drawbridge($app);
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
