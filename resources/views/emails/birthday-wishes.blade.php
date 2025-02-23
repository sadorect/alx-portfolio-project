@component('mail::message')
# 🎉 Happy Birthday {{ $celebrant->title }} {{ $celebrant->name }}!

{{ $message }}

We hope your special day is filled with:
- Joy and laughter
- Beautiful moments
- Wonderful surprises
- Unforgettable memories

@component('mail::button', ['url' => config('app.url'), 'color' => 'success'])
View Your Birthday Card
@endcomponent

@component('mail::panel')
"May this year bring you more happiness, success, and adventures!"
@endcomponent

Warmest Wishes,<br>
{{ config('app.name') }}

<x-mail::subcopy>
    Sent with ❤️ from {{ config('app.name') }}
</x-mail::subcopy>
@endcomponent