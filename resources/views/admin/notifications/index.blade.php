<x-layouts.admin>
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">System Notifications</h1>
        <button onclick="Livewire.emit('openNotificationForm')" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
            <i class="fas fa-plus mr-2"></i>Broadcast Message
        </button>
    </div>

    <livewire:admin.notifications-list />
</x-layouts.admin>
