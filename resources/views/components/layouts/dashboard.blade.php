<x-layouts.app>
    
  <!-- Dashboard Layout -->
  <div class="flex h-screen bg-gray-100">
      <!-- Sidebar -->
     @include('components.user-sidebar')
     

      <!-- Main Content -->
      <div class="flex-1 overflow-x-hidden overflow-y-auto">
          <!-- Header -->
          <header class="flex items-center justify-between h-16 px-6 bg-white border-b">
              <div class="flex items-center">
                  <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
              </div>
              <div class="flex items-center">
                  <div class="relative">
                      <button class="flex items-center text-gray-700 focus:outline-none">
                          <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                          <span class="mx-2">{{ auth()->user()->name }}</span>
                      </button>
                  </div>
              </div>
          </header>

          <!-- Dashboard Content -->
          <main class="p-6">
              <!-- Analytics Cards -->
             {{ $slot}}
          </main>
      </div>
  </div>


</x-layouts.app>
