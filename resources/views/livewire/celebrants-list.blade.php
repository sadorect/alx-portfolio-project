<div class="lg:pl-64 p-4 md:p-6 pt-20 transition-all duration-300">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex flex-col sm:flex-row gap-4 w-full">
            <input 
                wire:model.debounce.300ms="search" 
                type="text" 
                placeholder="Search celebrants..." 
                class="px-4 py-2 border rounded-lg w-full"
            >
            <select wire:model="filterType" class="px-4 py-2 border rounded-lg w-full sm:w-auto mt-2 sm:mt-0">
                <option value="">All Types</option>
                <option value="birthday">Birthday Only</option>
                <option value="wedding">Wedding Only</option>
            </select>
        </div>
        <a href="{{ route('celebrants.create') }}" class="w-full sm:w-auto px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 transition-colors duration-200 text-center">
            <i class="fas fa-plus mr-2"></i> Add Celebrant
        </a>
    </div>

    <!-- Desktop view table (hidden on small screens) -->
    <div class="hidden md:block bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th wire:click="sortBy('name')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            Name 
                            @if($sortField === 'name')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th wire:click="sortBy('email')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hidden lg:table-cell">
                            Email
                            @if($sortField === 'email')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th wire:click="sortBy('birthday')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            Birthday
                            @if($sortField === 'birthday')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th wire:click="sortBy('wedding')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hidden lg:table-cell">
                            Wedding
                            @if($sortField === 'wedding')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($celebrants as $celebrant)
                        <tr wire:key="{{ $celebrant->id }}">
                            <td class="px-4 py-3 whitespace-nowrap">
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
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                                {{ $celebrant->email }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $celebrant->birthday ? \Carbon\Carbon::parse($celebrant->birthday)->format('M d, Y') : '' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                                {{ $celebrant->wedding ? \Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') : '' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('celebrants.edit', $celebrant) }}" class="text-brand-600 hover:text-brand-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('celebrants.destroy', $celebrant) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                No celebrants found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tablet view (shown on medium screens) -->
    <div class="hidden sm:block md:hidden space-y-4">
        @forelse($celebrants as $celebrant)
            <div wire:key="{{ $celebrant->id }}" class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ $celebrant->title }} {{ $celebrant->name }}
                        </h3>
                        <p class="text-sm text-gray-500">{{ $celebrant->phone }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $celebrant->email }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('celebrants.edit', $celebrant) }}" class="p-2 text-brand-600 hover:text-brand-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('celebrants.destroy', $celebrant) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                    <div>
                        <span class="font-medium text-gray-500">Birthday:</span>
                        <p>{{ $celebrant->birthday ? \Carbon\Carbon::parse($celebrant->birthday)->format('M d, Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-500">Wedding:</span>
                        <p>{{ $celebrant->wedding ? \Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-4 text-center text-gray-500">
                No celebrants found
            </div>
        @endforelse
    </div>

    <!-- Mobile view cards (only on smallest screens) -->
    <div class="sm:hidden space-y-4">
        @forelse($celebrants as $celebrant)
            <div wire:key="{{ $celebrant->id }}" class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-base font-medium text-gray-900">
                            {{ $celebrant->title }} {{ $celebrant->name }}
                        </h3>
                        <p class="text-xs text-gray-500">{{ $celebrant->phone }}</p>
                    </div>
                    <div class="flex space-x-1">
                        <a href="{{ route('celebrants.edit', $celebrant) }}" class="p-1.5 text-brand-600 hover:text-brand-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('celebrants.destroy', $celebrant) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="mt-3 space-y-2 text-xs">
                    <p class="text-gray-500">{{ $celebrant->email }}</p>
                    <div class="border-t pt-2">
                        <span class="font-medium text-gray-500">Birthday:</span>
                        <p>{{ $celebrant->birthday ? \Carbon\Carbon::parse($celebrant->birthday)->format('M d, Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-500">Wedding:</span>
                        <p>{{ $celebrant->wedding ? \Carbon\Carbon::parse($celebrant->wedding)->format('M d, Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-4 text-center text-gray-500">
                No celebrants found
            </div>
        @endforelse

        
    </div>
    
    <div class="px-2 py-4 mt-4">
        {{ $celebrants->links() }}
    </div>
</div>
