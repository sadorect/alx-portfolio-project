<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-xl font-bold text-purple-600">Admin Panel</span>
                </div>
                @include('admin.partials.sidebar')
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="flex items-center justify-between h-16 px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-500 hover:text-gray-600 dark:text-gray-400" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Right Side Nav Items -->
                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-sm p-2.5">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>
                    
                    <div class="relative">
                        <button class="flex items-center text-gray-700 dark:text-gray-300">
                            <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin" alt="Admin">
                            <span class="ml-2">Admin</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div class="fixed inset-0 z-40 hidden" id="mobile-sidebar">
        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        <div class="absolute inset-y-0 left-0 flex flex-col w-64 bg-white dark:bg-gray-800">
            @include('admin.partials.sidebar')
        </div>
    </div>

    @livewireScripts
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            document.getElementById('mobile-sidebar').classList.toggle('hidden');
        });

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });
    </script>
</body>
</html>
