<x-mail::message>
# Login Link

You are receiving this email because we received a login request for your account.

If you did not request this, please contact us immediately.

@component('mail::button', ['url' => $url])
Login with Magic Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
