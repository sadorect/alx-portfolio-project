<x-layouts.admin>
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.activities') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Activities
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Activity Details</h1>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Activity Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">Type</label>
                            <p class="text-gray-900 dark:text-white">{{ str_replace('_', ' ', ucfirst($activity->type)) }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Description</label>
                            <p class="text-gray-900 dark:text-white">{{ $activity->description }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Date & Time</label>
                            <p class="text-gray-900 dark:text-white">{{ $activity->created_at->format('M d, Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">User Information</h3>
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name) }}" 
                             alt="{{ $activity->user->name }}">
                        <div class="ml-4">
                            <p class="text-gray-900 dark:text-white font-semibold">{{ $activity->user->name }}</p>
                            <p class="text-gray-500">{{ $activity->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
