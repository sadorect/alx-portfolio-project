<div x-data="{ sidebarOpen: false }" class="relative">
    <!-- Mobile sidebar toggle -->
    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed top-16 left-4 z-50 p-2 rounded-md bg-purple-600 text-white">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
         class="w-64 bg-white shadow-lg fixed inset-y-0 left-0 z-40 transform transition-transform duration-300 ease-in-out lg:translate-x-0 pt-16">
        <div class="flex items-center justify-center h-16 border-b">
            <svg class="w-8 h-8 text-purple-600" viewBox="0 0 40 40">
                <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
            </svg>
            <span class="ml-2 text-xl font-bold text-purple-600"></span>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-3">
                <a href="" class="flex items-center px-4 py-3 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }} rounded-lg">
                    <i class="fas fa- text-brand-600"></i>
                    <span class="mx-4">{{ $header ?? 'Dashboard' }}</span>
                </a>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }} rounded-lg">
                    <i class="fas fa-home text-brand-600"></i>
                    <span class="mx-4">Dashboard</span>
                </a>
                <a href="{{ route('celebrants.index') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->routeIs('celebrants.*') ? 'bg-gray-100' : '' }} hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-users text-brand-600"></i>
                    <span class="mx-4">Celebrants</span>
                </a>
                <a href="{{ route('birthdays') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->routeIs('birthdays') ? 'bg-gray-100' : '' }} hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-birthday-cake text-brand-600"></i>
                    <span class="mx-4">Birthdays</span>
                </a>
                <a href="{{ route('anniversaries') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->routeIs('anniversaries') ? 'bg-gray-100' : '' }} hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-ring text-brand-600"></i>
                    <span class="mx-4">Anniversaries</span>
                </a>
                <a href="{{ route('settings') }}" class="flex items-center px-4 py-3 text-gray-600 {{ request()->routeIs('settings') ? 'bg-gray-100' : '' }} hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-cog text-brand-600"></i>
                    <span class="mx-4">Settings</span>
                </a>
            </div>
        </nav>
    </div>
    
    <!-- Backdrop -->
    <div @click="sidebarOpen = false" 
         :class="{'block': sidebarOpen, 'hidden': !sidebarOpen}" 
         class="fixed inset-0 z-30 bg-gray-800 bg-opacity-50 lg:hidden"></div>
</div>
