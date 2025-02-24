<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">Recent Activity</h2>
    <div class="space-y-4">
        @foreach($activities as $activity)
            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div class="flex-shrink-0">
                    <span class="text-purple-600">
                        <i class="fas {{ $activity->icon }} text-2xl"></i>
                    </span>
                </div>
                <div class="ml-4">
                    <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $activity->user->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activity->description }}</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
        
        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
</div>
