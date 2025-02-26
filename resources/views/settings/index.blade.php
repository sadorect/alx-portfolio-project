<x-layouts.dashboard>
    <x-slot name="header">
        Settings
    </x-slot>

    <div class="lg:mx-60 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Notification Settings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Notification Preferences</h2>
            <livewire:notification-settings />
        </div>

        <!-- Template Customization -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Message Templates</h2>
            <livewire:template-settings />
        </div>
    </div>
</x-layouts.dashboard>
