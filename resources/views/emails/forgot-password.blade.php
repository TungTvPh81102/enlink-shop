@component('mail::message')

    # Welcome to {{ config('app.name') }}

    Quên mật khẩu

    <a class="btn btn-primary" " href="{{ route('auth.reset-password.show', ['token' => $verification_token]) }}">Reset Password</a>

    Thanks

@endcomponent
