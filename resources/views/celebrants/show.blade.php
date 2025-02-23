<x-layouts.dashboard>
  <x-slot name="header">
      Celebrant Details
  </x-slot>

  <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-lg shadow overflow-hidden">
          <div class="p-6">
              <div class="flex justify-between items-start">
                  <div>
                      <h2 class="text-2xl font-bold text-gray-900">{{ $celebrant->title }} {{ $celebrant->name }}</h2>
                      <p class="text-gray-500">Added on {{ $celebrant->created_at->format('M d, Y') }}</p>
                  </div>
                  <div class="flex space-x-4">
                      <a href="{{ route('celebrants.edit', $celebrant) }}" class="text-brand-600 hover:text-brand-700">
                          <i class="fas fa-edit"></i> Edit
                      </a>
                  </div>
              </div>

              <div class="mt-6 border-t border-gray-100 pt-6">
                  <dl class="divide-y divide-gray-100">
                      <div class="py-4 grid grid-cols-3">
                          <dt class="text-sm font-medium text-gray-500">Email</dt>
                          <dd class="text-sm text-gray-900 col-span-2">{{ $celebrant->email }}</dd>
                      </div>
                      <div class="py-4 grid grid-cols-3">
                          <dt class="text-sm font-medium text-gray-500">Phone</dt>
                          <dd class="text-sm text-gray-900 col-span-2">{{ $celebrant->phone }}</dd>
                      </div>
                      <div class="py-4 grid grid-cols-3">
                          <dt class="text-sm font-medium text-gray-500">Birthday</dt>
                          <dd class="text-sm text-gray-900 col-span-2">{{ $celebrant->birthday?->format('F d, Y') }}</dd>
                      </div>
                      <div class="py-4 grid grid-cols-3">
                          <dt class="text-sm font-medium text-gray-500">Wedding Anniversary</dt>
                          <dd class="text-sm text-gray-900 col-span-2">{{ $celebrant->wedding?->format('F d, Y') }}</dd>
                      </div>
                      <div class="py-4 grid grid-cols-3">
                          <dt class="text-sm font-medium text-gray-500">Notes</dt>
                          <dd class="text-sm text-gray-900 col-span-2">{{ $celebrant->notes }}</dd>
                      </div>
                  </dl>
              </div>
          </div>
      </div>
  </div>
</x-layouts.dashboard>
