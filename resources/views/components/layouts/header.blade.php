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
    <title>CelebrationHub - Never Miss Special Moments</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
    <!-- Add before closing </head> tag -->
@livewireStyles

</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Replace the logo section in nav with -->
<div class="flex items-center">
  <svg class="w-10 h-10 text-purple-600" viewBox="0 0 40 40">
      <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
  </svg>
  <span class="text-2xl font-bold text-purple-600 ml-2">CelebrationHub</span>
</div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{route('dashboard')}}" class="px-4 py-2 rounded-md text-purple-600 hover:text-purple-800">Dashboard</a>
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
                </div>            </div>
        </div>
    </nav>
