<x-layouts.admin>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">System Settings</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.settings.email') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center">
                <i class="fas fa-envelope text-3xl text-purple-600"></i>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Email Configuration</h3>
                    <p class="text-gray-600 dark:text-gray-400">Manage SMTP settings and email templates</p>
                </div>
            </div>
        </a>

        <!-- Add more setting category cards here -->
        <a href="{{ route('admin.settings.notifications') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center">
                        <i class="fas fa-bell text-3xl text-blue-600"></i>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Notification Settings</h3>
                            <p class="text-gray-600 dark:text-gray-400">Configure system notifications and alerts</p>
                        </div>
                    </div>
                </a>
         <!-- System Settings -->
         <a href="{{ route('admin.settings.system') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
          <div class="flex items-center">
              <i class="fas fa-cogs text-3xl text-green-600"></i>
              <div class="ml-4">
                  <h3 class="text-lg font-semibold">System Settings</h3>
                  <p class="text-gray-600 dark:text-gray-400">Configure timezone, date formats and maintenance</p>
              </div>
          </div>
      </a>
    </div>

    
</x-layouts.admin>
