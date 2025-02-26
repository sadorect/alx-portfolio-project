<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CelebrationHub - The smart way to manage and celebrate special moments. Never miss birthdays, anniversaries and special occasions again.">
    <meta name="keywords" content="birthday reminder, anniversary tracker, celebration manager, event reminder">
    <meta property="og:title" content="CelebrationHub - Never Miss Special Moments">
    <meta property="og:description" content="Smart celebration management platform for birthdays, anniversaries and special occasions">
    <meta property="og:image" content="/images/celebration-hub-og.jpg">
    <link rel="icon" type="image/svg+xml" href="/images/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <title>MyAnniversary - Never Miss Special Moments</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav x-data="{ mobileMenuOpen: false }" class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <svg class="w-10 h-10 text-purple-600" viewBox="0 0 40 40">
                        <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                    </svg>
                    <span class="text-2xl font-bold text-purple-600 ml-2">MyAnniversary</span>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{route('dashboard')}}" class="px-4 py-2 rounded-md text-purple-600 hover:text-purple-800">{{ $header ?? 'Dashboard'}}</a>
                        <div class="relative">
                            <button class="flex items-center text-gray-700 focus:outline-none">
                                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                                <span class="mx-2">{{ auth()->user()->name }}</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Logout</button>
                        </form>
                    @else
                        <a href="{{route('login')}}" class="px-4 py-2 rounded-md text-purple-600 hover:text-purple-800">Login</a>
                        <a href="{{route('register')}}" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Get Started</a>
                    @endauth
                </div>  
            </div>
            
            <!-- Mobile menu -->
            <div x-show="mobileMenuOpen" class="md:hidden py-4 border-t border-gray-200">
                @auth
                    <a href="{{route('dashboard')}}" class="block py-2 px-4 text-sm text-purple-600">{{ $header ?? 'Dashboard'}}</a>
                    <div class="py-2 px-4 text-sm text-gray-700">
                        <div class="flex items-center">
                            <img class="w-6 h-6 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                            <span class="ml-2">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="block py-2 px-4">
                        @csrf
                        <button type="submit" class="text-sm text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{route('login')}}" class="block py-2 px-4 text-sm text-purple-600">Login</a>
                    <a href="{{route('register')}}" class="block py-2 px-4 text-sm text-purple-600">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>
