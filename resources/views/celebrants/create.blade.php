<x-layouts.dashboard>
  <x-slot name="header">
      Add New Celebrant
  </x-slot>

  <div class="max-w-2xl mx-auto">
      <form action="{{ route('celebrants.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
          @csrf
          <div class="space-y-6">
              <div>
                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                  <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                  <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                  <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                  <input type="date" name="birthday" id="birthday" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="wedding" class="block text-sm font-medium text-gray-700">Wedding Anniversary</label>
                  <input type="date" name="wedding" id="wedding" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
              </div>

              <div>
                  <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                  <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500"></textarea>
              </div>

              <div class="flex justify-end">
                
                  <a href="{{ route('celebrants.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">
                      Cancel
                  </a>
                  <button type="submit" class="bg-brand-600 text-white px-4 py-2 rounded-lg hover:bg-brand-700">
                      Save Celebrant
                  </button>
              </div>
          </div>
      </form>
  </div>
</x-layouts.dashboard>
