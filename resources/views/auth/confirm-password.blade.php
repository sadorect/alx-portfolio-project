<x-app-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
          <div class="text-center">
              <div class="flex justify-center">
                  <svg class="w-12 h-12 text-purple-600" viewBox="0 0 40 40">
                      <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                  </svg>
              </div>
              <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Confirm Password</h2>
              <p class="mt-2 text-sm text-gray-600">
                  This is a secure area. Please confirm your password before continuing.
              </p>
          </div>

          <form class="mt-8 space-y-6" action="{{ route('password.confirm') }}" method="POST">
              @csrf
              <div>
                  <label for="password" class="sr-only">Password</label>
                  <input id="password" name="password" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Password">
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                  Confirm Password
              </button>
          </form>
      </div>
  </div>
</x-app-layout>
