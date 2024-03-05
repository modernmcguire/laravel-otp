<?php

use Illuminate\Support\Facades\Route;
use ModernMcGuire\LaravelOtp\Controllers\MagicLinkController;
use ModernMcGuire\LaravelOtp\Controllers\OtpVerificationController;

Route::middleware(['web'])->group(function () {
    Route::get('otp/verify', [OtpVerificationController::class, 'show'])->name('otp.show');
    Route::post('otp/verify', [OtpVerificationController::class, 'verify'])->name('otp.verify');
    Route::post('otp/resend', [OtpVerificationController::class, 'resend'])->name('otp.resend');

    Route::get('/magic-link', [MagicLinkController::class, 'store'])->name('magic-login');
    Route::get('/magic-link/verify', [MagicLinkController::class, 'show'])->name('magic-login-verify');
});
