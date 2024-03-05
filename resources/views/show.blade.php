@extends('layouts.app')

@section('page-title', "Verify Your Account")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two-Factor Authentication') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification code has been sent to you.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email or phone for a verification code.') }}
                    {{ __('If you did not receive the notification') }},
                    <form class="d-inline" method="post" action="{{ route('otp.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>

                    <form class="mt-4" action="{{ route('otp.verify') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                            @error('otp')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
