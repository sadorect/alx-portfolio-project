<div>
    <form wire:submit.prevent="saveSettings">
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700">Email Notifications</label>
                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                    <input type="checkbox" wire:model="emailEnabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-700">SMS Notifications</label>
                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                    <input type="checkbox" wire:model="smsEnabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Days Before Event</label>
                <select wire:model="daysBeforeNotification" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
                    @foreach([1,2,3,5,7,14] as $days)
                        <option value="{{ $days }}">{{ $days }} days</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Notification Time</label>
                <input type="time" wire:model="notificationTime" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-brand-600 text-white px-4 py-2 rounded-lg hover:bg-brand-700">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
