<x-layouts.dashboard>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-users text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Contacts</h3>
                    <p class="text-2xl font-semibold">{{ $totalContacts ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-birthday-cake text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Upcoming Birthdays</h3>
                    <p class="text-2xl font-semibold">{{ $upcomingBirthdays ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-ring text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Upcoming Anniversaries</h3>
                    <p class="text-2xl font-semibold">{{ $upcomingAnniversaries ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <i class="fas fa-envelope text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Wishes Sent</h3>
                    <p class="text-2xl font-semibold">{{ $wishesSent ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar & Upcoming Events -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Calendar</h2>
            <div id="calendar" class="min-h-[400px]"></div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Upcoming Celebrations</h2>
            <div class="space-y-4">
                @forelse($upcomingEvents ?? [] as $event)
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0">
                            <span class="text-purple-600">
                                <i class="fas {{ $event->type === 'birthday' ? 'fa-birthday-cake' : 'fa-ring' }} text-2xl"></i>
                            </span>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold">{{ $event->name }}</p>
                            <p class="text-sm text-gray-500">{{ $event->date->format('M d, Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No upcoming celebrations</p>
                @endforelse
            </div>
        </div>
    </div>

</x-layouts.dashboard>