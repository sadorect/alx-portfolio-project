<x-layouts.dashboard>
    @php
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            $totalContacts = \App\Models\Celebrant::count();
            $newContactsThisMonth = \App\Models\Celebrant::whereMonth('created_at', now()->month)->count();
            $nextDays = 30;
            $allUpcomingEvents = (new \App\Http\Livewire\UpcomingEventsTimeline())->getUpcomingEvents($nextDays);
                    $totalBirthdays = $allUpcomingEvents->where('type', 'birthday')->count();
$totalAnniversaries = $allUpcomingEvents->where('type', 'anniversary')->count();
$totalCelebrations = $totalAnniversaries + $totalBirthdays;
        }
    @endphp
    <!-- Main content area with proper spacing for sidebar -->
    <div class="lg:pl-64 p-4 md:p-6 pt-20 transition-all duration-300">
        <!-- Analytics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex items-center">
                    <i class="fas fa-users text-2xl md:text-3xl text-purple-600"></i>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-xs md:text-sm">Total Contacts</h3>
                        <p class="text-xl md:text-2xl font-semibold">{{ $totalContacts ?? 0 }}</p>
                        <span class="text-xs md:text-sm text-green-500">+{{ $newContactsThisMonth ?? 0 }} this month</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex items-center">
                    <i class="fas fa-birthday-cake text-2xl md:text-3xl text-purple-600"></i>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-xs md:text-sm">Upcoming Birthdays</h3>
                        <p class="text-xl md:text-2xl font-semibold">{{ $totalBirthdays ?? 0 }}</p>
                        <span class="text-xs md:text-sm text-gray-500">Next {{$nextDays}} days</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex items-center">
                    <i class="fas fa-ring text-2xl md:text-3xl text-purple-600"></i>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-xs md:text-sm">Upcoming Anniversaries</h3>
                        <p class="text-xl md:text-2xl font-semibold">{{ $totalAnniversaries ?? 0 }}</p>
                        <span class="text-xs md:text-sm text-gray-500">Next {{$nextDays}} days</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex items-center">
                    <i class="fas fa-envelope text-2xl md:text-3xl text-purple-600"></i>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-xs md:text-sm">Wishes Sent</h3>
                        <p class="text-xl md:text-2xl font-semibold">{{ $wishesSent ?? 0 }}</p>
                        <span class="text-xs md:text-sm text-gray-500">This month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Celebration Distribution -->
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <h2 class="text-base lg:text-lg font-semibold mb-4">Monthly Distribution</h2>
                <livewire:monthly-celebration-chart />
            </div>

            <!-- Upcoming Events Timeline -->
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <h2 class="text-base lg:text-lg font-semibold mb-4">Next {{$nextDays}} Days</h2>
                <livewire:upcoming-events-timeline :days=$nextDays />
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <h2 class="text-base lg:text-lg font-semibold mb-4">Recent Activity</h2>
                <livewire:recent-activity />
            </div>
        </div>
    </div>
</x-layouts.dashboard>
