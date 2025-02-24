<x-layouts.admin>
  <div class="mb-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
          <a href="{{ route('admin.users') }}" class="flex items-center text-gray-600 hover:text-gray-900">
              <i class="fas fa-arrow-left mr-2"></i>
              Back to Users
          </a>
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">User Profile</h1>
      </div>
  </div>

  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
      <div class="p-8">
          <div class="flex items-center mb-8">
              <img class="h-20 w-20 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff" alt="">
              <div class="ml-6">
                  <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                  <p class="text-gray-500">{{ $user->email }}</p>
              </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div class="bg-purple-50 dark:bg-gray-700 p-6 rounded-lg">
                  <div class="text-purple-600 dark:text-purple-400 text-lg mb-2">Celebrants</div>
                  <div class="text-3xl font-bold">{{ $user->celebrants->count() }}</div>
              </div>

              <div class="bg-blue-50 dark:bg-gray-700 p-6 rounded-lg">
                  <div class="text-blue-600 dark:text-blue-400 text-lg mb-2">Activities</div>
                  <div class="text-3xl font-bold">{{ $user->activities->count() }}</div>
              </div>

              <div class="bg-green-50 dark:bg-gray-700 p-6 rounded-lg">
                  <div class="text-green-600 dark:text-green-400 text-lg mb-2">Member Since</div>
                  <div class="text-3xl font-bold">{{ $user->created_at->format('M Y') }}</div>
              </div>
          </div>

          <div class="mt-8">
              <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Recent Activity</h3>
              <div class="space-y-4">
                  @forelse($user->activities->take(5) as $activity)
                      <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                          <div class="flex-shrink-0">
                              <i class="fas fa-history text-purple-600"></i>
                          </div>
                          <div class="ml-4">
                              <p class="text-gray-900 dark:text-white">{{ $activity->description }}</p>
                              <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                          </div>
                      </div>
                  @empty
                      <p class="text-gray-500 text-center py-4">No recent activity</p>
                  @endforelse
              </div>
          </div>
      </div>
  </div>
</x-layouts.admin>
