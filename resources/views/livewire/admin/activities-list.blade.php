<div>
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex gap-4 w-full sm:w-auto">
            <input 
                wire:model.debounce.300ms="search" 
                type="text" 
                placeholder="Search by user..." 
                class="px-4 py-2 border rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:border-gray-600"
            >
            <select 
                wire:model="type" 
                class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600"
            >
                <option value="">All Activities</option>
                <option value="login">Logins</option>
                <option value="celebrant_added">Celebrants Added</option>
                <option value="wish_sent">Wishes Sent</option>
            </select>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Activity
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Details
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($activities as $activity)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($activity->user->name) }}" 
                                         alt="{{ $activity->user->name }}">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $activity->user->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $activity->description }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $activity->type === 'login' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $activity->type === 'celebrant_added' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $activity->type === 'wish_sent' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ str_replace('_', ' ', ucfirst($activity->type)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.activities.show', $activity) }}" 
                                   class="text-purple-600 hover:text-purple-900">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No activities found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $activities->links() }}
        </div>
    </div>
</div>
