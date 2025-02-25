<x-layouts.admin>
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.notifications') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Notifications
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Notification Details</h1>
        </div>
        
        @if($notification->status === 'pending')
            <form action="{{ route('admin.notifications.resolve', $notification) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Mark as Resolved
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Notification Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">Type</label>
                            <p class="text-gray-900 dark:text-white">{{ ucfirst($notification->type) }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Message</label>
                            <p class="text-gray-900 dark:text-white">{{ $notification->message }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Priority</label>
                            <span class="px-3 py-1 rounded-full text-sm
                                {{ $notification->priority === 'high' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $notification->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $notification->priority === 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst($notification->priority) }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Status</label>
                            <span class="px-3 py-1 rounded-full text-sm
                                {{ $notification->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($notification->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Created</label>
                            <p class="text-gray-900 dark:text-white">{{ $notification->created_at->format('M d, Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                @if($notification->data)
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Additional Data</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <pre class="text-sm text-gray-900 dark:text-white">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
