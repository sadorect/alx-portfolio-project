<x-layouts.dashboard>
    <x-slot name="header">
        Wedding Anniversaries
    </x-slot>

    <div class="lg:ml-60 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Today's Anniversaries -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Today's Anniversaries</h2>
            <livewire:today-anniversaries />
        </div>

        <!-- This Week -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">This Week</h2>
            <livewire:weekly-anniversaries />
        </div>

        <!-- This Month -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">This Month</h2>
            <livewire:monthly-anniversaries />
        </div>
    </div>
</x-layouts.dashboard>
