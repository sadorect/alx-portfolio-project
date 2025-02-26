<div class="space-y-3">
    @forelse($celebrants as $celebrant)
        <div class="flex items-center space-x-3 md:space-x-4">
            <div class="flex-shrink-0">
                <span class="inline-flex items-center justify-center h-8 w-8 md:h-10 md:w-10 rounded-full bg-brand-100 text-brand-600">
                    <i class="fas fa-ring text-xs md:text-sm"></i>
                </span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm md:text-base font-medium truncate">{{ $celebrant->name }}</p>
                <p class="text-xs md:text-sm text-gray-500">
                    {{ Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') }}
                </p>
            </div>
            <div class="w-24 flex-shrink-0 text-xs md:text-sm text-gray-400 text-right">
                @php
                    $anniversaryThisYear = Carbon\Carbon::parse($celebrant->wedding)->setYear((int)date('Y'));
                    $now = Carbon\Carbon::now();
                    $daysUntil = $now->diffInDays($anniversaryThisYear, false);
                    $years = (int)date('Y') - Carbon\Carbon::parse($celebrant->wedding)->year;
                    
                    if ($daysUntil < 0) {
                        echo abs(ceil($daysUntil)) . " days ago";
                    } elseif ($daysUntil == 0) {
                        echo "Today! (" . $years . " years)";
                    } else {
                        echo "in " . ceil($daysUntil). " days";
                    }   
                    
                @endphp
            </div>
        </div>
        @if(!$loop->last)
            <div class="border-t border-gray-100 my-2"></div>
        @endif
    @empty
        <div class="text-gray-500 text-center py-6">
            <i class="fas fa-ring text-gray-300 text-2xl mb-2"></i>
            <p>No anniversaries this month</p>
        </div>
    @endforelse
    
    @if(count($celebrants) > 0)
        <div class="mt-4 text-center">
            <a href="{{ route('anniversaries') }}" class="text-brand-600 text-sm hover:text-brand-800">
                View all anniversaries <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    @endif
</div>
