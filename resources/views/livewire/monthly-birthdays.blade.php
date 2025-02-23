<div>
    @forelse($celebrants as $celebrant)
        <div class="flex items-center space-x-4 mb-4">
            <div class="flex-shrink-0">
                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-brand-100 text-brand-600">
                    {{ strtoupper(substr($celebrant->name, 0, 1)) }}
                </span>
            </div>
            <div>
                <p class="font-medium">{{ $celebrant->name }}</p>
                <p class="text-sm text-gray-500">
                    {{ Carbon\Carbon::parse($celebrant->birthday)->format('M d') }}
                </p>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center">No birthdays this month</p>
    @endforelse
</div>
