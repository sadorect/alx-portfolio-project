<x-layouts.app>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.user-sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b">
                <div class="flex items-center">
                    {{ $header ?? 'Dashboard' }}
                </div>
               
            </header>

            <!-- Main Content Area -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.app>
