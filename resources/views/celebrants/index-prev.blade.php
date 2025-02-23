<x-layouts.dashboard>
  <x-slot name="header">
      Manage Celebrants
  </x-slot>

  <div class="mb-6 flex justify-between items-center">
      <div class="flex gap-4">
          <a href="{{ route('celebrants.create') }}" class="bg-brand-600 text-white px-4 py-2 rounded-lg hover:bg-brand-700">
              <i class="fas fa-plus mr-2"></i> Add Celebrant          </a>
      </div>
      <div class="flex gap-4">
          <input type="text" placeholder="Search celebrants..." class="px-4 py-2 border rounded-lg">
      </div>
  </div>

  <div class="bg-white rounded-lg shadow">
      <table class="min-w-full">
          <thead class="bg-gray-50">
              <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                  <!--th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th-->
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Birthday</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wedding</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
              @forelse($celebrants as $celebrant)
                  <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                              <div>
                                  <div class="text-sm font-medium text-gray-900">{{ $celebrant->title }} {{ $celebrant->name }}</div>
                                  <div class="text-sm text-gray-500">{{ $celebrant->phone }}</div>
                              </div>
                          </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $celebrant->email }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $celebrant->birthday ? \Carbon\Carbon::parse($celebrant->birthday)->format('M d, Y') : '' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $celebrant->wedding ? \Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') : '' }}</td>                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <a href="{{ route('celebrants.edit', $celebrant) }}" class="text-brand-600 hover:text-brand-900">Edit</a>
                          <form action="{{ route('celebrants.destroy', $celebrant) }}" method="POST" class="inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                          </form>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="px-6 py-4 text-center text-gray-500">No celebrants found</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>
</x-layouts.dashboard>
