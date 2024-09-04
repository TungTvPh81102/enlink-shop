@component('mail::message')

    # Welcome to {{ config('app.name') }}

    Thanks for signing up! Please click the button below to verify your email address.

    @component('mail::button', ['url' => route('auth.verify', $verification_token)])
        Verify Email
    @endcomponent

    Thanks

@endcomponent
