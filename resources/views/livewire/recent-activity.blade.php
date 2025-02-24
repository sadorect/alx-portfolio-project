<div class="flow-root">
    <ul role="list" class="-mb-8">
        @forelse($activities as $activity)
            <li>
                <div class="relative pb-8">
                    @if(!$loop->last)
                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    @endif
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white {{ $activity['color'] }} bg-opacity-10">
                                <i class="fas {{ $activity['icon'] }} {{ $activity['color'] }}"></i>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                            <div>
                                <p class="text-sm text-gray-500">{{ $activity['description'] }}</p>
                            </div>
                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                <time datetime="{{ $activity['created_at'] }}">
                                    {{ Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}
                                </time>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="text-center text-gray-500 py-4">No recent activity</li>
        @endforelse
    </ul>
</div>
