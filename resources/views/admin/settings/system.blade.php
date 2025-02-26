<x-layouts.admin>
    <div class="mb-6 flex items-center space-x-4">
        <a href="{{ route('admin.settings') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">System Settings</h1>
    </div>

    <livewire:admin.system-settings />
</x-layouts.admin>
