<div>
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex gap-4 w-full sm:w-auto">
            <select wire:model="type" class="rounded-lg border-gray-300 dark:border-gray-600">
                <option value="">All Types</option>
                <option value="system">System</option>
                <option value="email">Email</option>
                <option value="user">User</option>
            </select>
            <select wire:model="status" class="rounded-lg border-gray-300 dark:border-gray-600">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="resolved">Resolved</option>
            </select>
            <select wire:model="priority" class="rounded-lg border-gray-300 dark:border-gray-600">
                <option value="">All Priorities</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        @foreach($notifications as $notification)
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="flex-shrink-0">
                            <i class="fas fa-bell text-2xl 
                                {{ $notification->priority === 'high' ? 'text-red-500' : '' }}
                                {{ $notification->priority === 'medium' ? 'text-yellow-500' : '' }}
                                {{ $notification->priority === 'low' ? 'text-green-500' : '' }}">
                            </i>
                        </span>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $notification->type }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $notification->message }}</p>
                            <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 rounded-full text-sm
                            {{ $notification->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($notification->status) }}
                        </span>
                        <a href="{{ route('admin.notifications.show', $notification) }}" 
                           class="text-purple-600 hover:text-purple-900">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="p-6">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
