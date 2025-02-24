<nav class="flex-1 px-2 py-4 space-y-1">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-100 text-purple-600 dark:bg-purple-900' : 'text-gray-600 dark:text-gray-300' }} hover:bg-purple-50 dark:hover:bg-purple-900 rounded-lg">
        <i class="fas fa-chart-line w-5 h-5"></i>
        <span class="mx-4">Dashboard</span>
    </a>

    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users*') ? 'bg-purple-100 text-purple-600 dark:bg-purple-900' : 'text-gray-600 dark:text-gray-300' }} hover:bg-purple-50 dark:hover:bg-purple-900 rounded-lg">
        <i class="fas fa-users w-5 h-5"></i>
        <span class="mx-4">Users</span>
    </a>

    <a href="{{ route('admin.activities') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.activities') ? 'bg-purple-100 text-purple-600 dark:bg-purple-900' : 'text-gray-600 dark:text-gray-300' }} hover:bg-purple-50 dark:hover:bg-purple-900 rounded-lg">
        <i class="fas fa-history w-5 h-5"></i>
        <span class="mx-4">Activities</span>
    </a>

    <a href="{{ route('admin.notifications') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.notifications') ? 'bg-purple-100 text-purple-600 dark:bg-purple-900' : 'text-gray-600 dark:text-gray-300' }} hover:bg-purple-50 dark:hover:bg-purple-900 rounded-lg">
        <i class="fas fa-bell w-5 h-5"></i>
        <span class="mx-4">Notifications</span>
    </a>

    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.settings') ? 'bg-purple-100 text-purple-600 dark:bg-purple-900' : 'text-gray-600 dark:text-gray-300' }} hover:bg-purple-50 dark:hover:bg-purple-900 rounded-lg">
        <i class="fas fa-cog w-5 h-5"></i>
        <span class="mx-4">Settings</span>
    </a>
</nav>
