<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Notification Preferences</h2>

    <form wire:submit.prevent="saveSettings" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Reminder Settings -->
            <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-medium border-b pb-2">Reminder Settings</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Days Before Event</label>
                    <input type="number" wire:model="reminder_days_before" min="1" max="30" 
                        class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600">
                    @error('reminder_days_before') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reminder Time</label>
                    <input type="time" wire:model="reminder_time" 
                        class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600">
                    @error('reminder_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Notification Channels -->
            <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-medium border-b pb-2">Notification Channels</h3>
                
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="notification_types.email" 
                            class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Email Notifications</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" wire:model="notification_types.database" 
                            class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">In-App Notifications</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" wire:model="notification_types.sms" 
                            class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">SMS Notifications</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit" 
                class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow-sm transition duration-150 hover:shadow focus:outline-none focus:ring-2 focus:ring-purple-500">
                Save Preferences
            </button>
        </div>
    </form>
</div>
