@component('mail::message')
# Happy Wedding Anniversary {{ $celebrant->title }} {{ $celebrant->name }}!

Congratulations on another year of love, laughter, and beautiful memories together. May your journey continue to be filled with joy and endless blessings.

@component('mail::button', ['url' => ''])
Celebrate Now
@endcomponent

Best Wishes,<br>
{{ config('app.name') }}
@endcomponent
