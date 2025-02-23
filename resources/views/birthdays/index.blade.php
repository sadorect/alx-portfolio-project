<x-layouts.dashboard>
    <x-slot name="header">
        Upcoming Birthdays
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Today's Birthdays -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Today's Birthdays</h2>
            <livewire:today-birthdays />
        </div>

        <!-- This Week -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">This Week</h2>
            <livewire:weekly-birthdays />
        </div>

        <!-- This Month -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">This Month</h2>
            <livewire:monthly-birthdays />
        </div>
    </div>
</x-layouts.dashboard>
