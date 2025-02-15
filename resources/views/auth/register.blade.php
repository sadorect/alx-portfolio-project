<x-app-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
          <div class="text-center">
              <div class="flex justify-center">
                  <svg class="w-12 h-12 text-purple-600" viewBox="0 0 40 40">
                      <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                  </svg>
              </div>
              <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Create your account</h2>
              <p class="mt-2 text-sm text-gray-600">
                  Already registered?
                  <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                      Sign in here
                  </a>
              </p>
          </div>

          <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
              @csrf
              <div class="rounded-md shadow-sm space-y-4">
                  <div>
                      <label for="name" class="sr-only">Full Name</label>
                      <input id="name" name="name" type="text" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Full Name">
                  </div>
                  <div>
                      <label for="email" class="sr-only">Email address</label>
                      <input id="email" name="email" type="email" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Email address">
                  </div>
                  <div>
                      <label for="password" class="sr-only">Password</label>
                      <input id="password" name="password" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Password">
                  </div>
                  <div>
                      <label for="password_confirmation" class="sr-only">Confirm Password</label>
                      <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                  </div>
              </div>

              <div>
                  <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                      Create Account
                  </button>
              </div>
          </form>
      </div>
  </div>
</x-app-layout>
