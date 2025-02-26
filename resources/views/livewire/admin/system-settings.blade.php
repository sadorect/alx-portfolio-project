<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h2 class="text-xl font-semibold mb-6">System Settings</h2>

    <form wire:submit.prevent="saveSettings" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- General Settings -->
            <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-medium border-b pb-2">General Settings</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Timezone</label>
                    <select wire:model="timezone" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600">
                        @foreach(timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}">{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Format</label>
                    <select wire:model="date_format" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600">
                        <option value="Y-m-d">2024-02-25</option>
                        <option value="m/d/Y">02/25/2024</option>
                        <option value="d/m/Y">25/02/2024</option>
                        <option value="M d, Y">Feb 25, 2024</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Default Language</label>
                    <select wire:model="default_language" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600">
                        <option value="en">English</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                    </select>
                </div>
            </div>

            <!-- System Controls -->
            <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-medium border-b pb-2">System Controls</h3>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Maintenance Mode</span>
                    <div class="flex items-center">
                        <button type="button" wire:click="$set('maintenance_mode', !maintenance_mode)" 
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 {{ $maintenance_mode ? 'bg-purple-600' : 'bg-gray-200' }}">
                            <span class="sr-only">Toggle Maintenance Mode</span>
                            <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $maintenance_mode ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Enable Registration</span>
                    <div class="flex items-center">
                        <button type="button" wire:click="$set('registration_enabled', !registration_enabled)"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 {{ $registration_enabled ? 'bg-purple-600' : 'bg-gray-200' }}">
                            <span class="sr-only">Toggle Registration</span>
                            <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $registration_enabled ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit" 
                wire:click="saveSettings"
                class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow-sm transition duration-150 hover:shadow focus:outline-none focus:ring-2 focus:ring-purple-500">
                Save Settings
            </button>        </div>
    </form>

    <!-- Success Message -->
    <div x-data="{ show: false, message: '' }"
         x-on:settings-saved.window="show = true; message = 'Settings saved successfully!'; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
         role="alert">
        <p x-text="message"></p>
    </div>
</div>
