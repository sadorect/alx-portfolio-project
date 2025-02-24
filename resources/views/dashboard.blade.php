<x-layouts.dashboard>
    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-users text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Contacts</h3>
                    <p class="text-2xl font-semibold">{{ $totalContacts ?? 0 }}</p>
                    <span class="text-sm text-green-500">+{{ $newContactsThisMonth ?? 0 }} this month</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-birthday-cake text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Upcoming Birthdays</h3>
                    <p class="text-2xl font-semibold">{{ $upcomingBirthdays ?? 0 }}</p>
                    <span class="text-sm text-gray-500">Next 30 days</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-ring text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Upcoming Anniversaries</h3>
                    <p class="text-2xl font-semibold">{{ $upcomingAnniversaries ?? 0 }}</p>
                    <span class="text-sm text-gray-500">Next 30 days</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-envelope text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Wishes Sent</h3>
                    <p class="text-2xl font-semibold">{{ $wishesSent ?? 0 }}</p>
                    <span class="text-sm text-gray-500">This month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Celebration Distribution -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Monthly Distribution</h2>
            <livewire:monthly-celebration-chart />
        </div>

        <!-- Upcoming Events Timeline -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Next 7 Days</h2>
            <livewire:upcoming-events-timeline />
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
            <livewire:recent-activity />
        </div>
    </div>
</x-layouts.dashboard>