<x-layouts.admin>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-users text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Users</h3>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalUsers }}</p>
                    <span class="text-sm text-green-500">+{{ $newUsers }} this week</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-calendar-check text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Celebrations</h3>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalCelebrations ?? 0}}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-envelope text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm">Notifications Sent</h3>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $notificationsSent }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-user-clock text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm">Active Users</h3>
                    <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $activeUsers }}</p>
                    <span class="text-sm text-gray-500">Last 24 hours</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <livewire:admin.user-growth-chart />
        <livewire:admin.activity-log />
    </div>
</x-layouts.admin>
