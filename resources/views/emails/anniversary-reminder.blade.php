@component('mail::message')
# {{ $notificationType == 'reminder' ? 'Upcoming ' . ($eventType == 'birthday' ? 'Birthday' : 'Anniversary') : 'Today\'s Special Day!' }}

@if($notificationType == 'reminder')
This is a reminder that {{ $celebrant->name }}'s {{ $eventType == 'birthday' ? 'birthday' : 'wedding anniversary' }} is coming up on {{ $eventDate->format('F j') }}.

Don't forget to wish them well on their special day!
@else
Today is {{ $celebrant->name }}'s {{ $eventType == 'birthday' ? 'birthday' : 'wedding anniversary' }}!

{{ $eventType == 'birthday' 
    ? Carbon\Carbon::parse($celebrant->birthday)->age . ' years old today!' 
    : Carbon\Carbon::parse($celebrant->wedding)->age . ' years of celebration!' }}
@endif

@component('mail::button', ['url' => url('/celebrants')])
View Celebrants
@endcomponent

Best,<br>
{{ config('app.name') }}
@endcomponent
