<x-mail::message>
# Verification Code

Your OTP is: {{ $otp }}

If you did not request this, please contact us immediately.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
