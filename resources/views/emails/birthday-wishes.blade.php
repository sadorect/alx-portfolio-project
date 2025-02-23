@component('mail::message')
# Happy Birthday {{ $celebrant->title }} {{ $celebrant->name }}!

Wishing you a fantastic birthday filled with joy and wonderful moments. May this special day bring you happiness and all that you wish for.

@component('mail::button', ['url' => ''])
Celebrate Now
@endcomponent

Best Wishes,<br>
{{ config('app.name') }}
@endcomponent
