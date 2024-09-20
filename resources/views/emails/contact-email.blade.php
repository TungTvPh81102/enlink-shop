@component('mail::message')
    # New Contact Request

    <h1>New Contact Request</h1>
    <p><strong>Name:</strong> {{ $contactData['full_name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactData['message'] }}</p>
    Thanks,
    {{ config('app.name') }}
@endcomponent
