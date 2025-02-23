<div>
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex gap-4 w-full sm:w-auto">
            <input 
                wire:model.debounce.300ms="search" 
                type="text" 
                placeholder="Search celebrants..." 
                class="px-4 py-2 border rounded-lg w-full sm:w-auto"
            >
            <select wire:model="filterType" class="px-4 py-2 border rounded-lg">
                <option value="">All Types</option>
                <option value="birthday">Birthday Only</option>
                <option value="wedding">Wedding Only</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Name 
                        @if($sortField === 'name')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('email')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Email
                        @if($sortField === 'email')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('birthday')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Birthday
                        @if($sortField === 'birthday')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('wedding')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Wedding
                        @if($sortField === 'wedding')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($celebrants as $celebrant)
                    <tr wire:key="{{ $celebrant->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $celebrant->title }} {{ $celebrant->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $celebrant->phone }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $celebrant->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $celebrant->birthday ? \Carbon\Carbon::parse($celebrant->birthday)->format('M d, Y') : '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $celebrant->wedding ? \Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') : '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No celebrants found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $celebrants->links() }}
        </div>
    </div>
</div>
