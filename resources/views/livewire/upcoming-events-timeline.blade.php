<div class="space-y-4">
    @forelse($events as $event)
        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
            <div class="flex-shrink-0">
                <span class="text-purple-600">
                    <i class="fas {{ $event['type'] === 'birthday' ? 'fa-birthday-cake' : 'fa-ring' }} text-2xl"></i>
                </span>
            </div>
            <div class="ml-4">
                <p class="font-semibold">{{ $event['name'] }}</p>
                <p class="text-sm text-gray-500">
                    {{ Carbon\Carbon::parse($event['date'])->format('M d, Y') }}
                    ({{ Carbon\Carbon::parse($event['date'])->diffForHumans() }})
                </p>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center">No upcoming events in the next {{$days}} days</p>
    @endforelse
</div>
