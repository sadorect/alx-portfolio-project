@component('mail::message')
# {{ $eventType == 'birthday' ? 'Happy Birthday!' : 'Happy Anniversary!' }}

{{ $message }}

Wishing you all the best on your special day!

Best regards,<br>
{{ $user->name }}
@endcomponent
