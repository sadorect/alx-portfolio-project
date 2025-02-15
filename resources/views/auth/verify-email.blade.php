<x-app-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <div class="mb-4 text-sm text-gray-600">
          {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
      </div>
  
      @if (session('status') == 'verification-link-sent')
          <div class="mb-4 font-medium text-sm text-green-600">
              {{ __('A new verification link has been sent to the email address you provided during registration.') }}
          </div>
      @endif
          <div class="text-center">
              <div class="flex justify-center">
                  <svg class="w-12 h-12 text-purple-600" viewBox="0 0 40 40">
                      <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                  </svg>
              </div>
              <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Verify Your Email</h2>
              <p class="mt-2 text-sm text-gray-600">
                  Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
              </p>
          </div>

          <div class="flex items-center justify-between">
              <form method="POST" action="{{ route('verification.send') }}">
                  @csrf
                  <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                      Resend Verification Email
                  </button>
              </form>
          </div>
      </div>
  </div>
</x-app-layout>
