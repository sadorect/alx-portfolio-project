@component('mail::message')
# 💑 Happy Wedding Anniversary!

{{ $message }}

Celebrating your love story:
- Another year of beautiful memories
- Growing stronger together
- Building dreams as one
- Sharing life's precious moments

@component('mail::button', ['url' => config('app.url'), 'color' => 'success'])
View Your Anniversary Card
@endcomponent

@component('mail::panel')
"Here's to many more years of love, laughter, and happiness together!"
@endcomponent

With Love,<br>
{{ config('app.name') }}

<x-mail::subcopy>
    Sent with ❤️ from {{ config('app.name') }}
</x-mail::subcopy>
@endcomponent