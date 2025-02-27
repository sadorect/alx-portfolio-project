<div>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4 mb-6">
            <div class="flex-1">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search notifications..." 
                    class="w-full px-4 py-2 border rounded-md">
            </div>
            
            <div class="flex space-x-2">
                <select wire:model="type" class="px-4 py-2 border rounded-md">
                    <option value="">All Types</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}">{{ ucwords(str_replace('_', ' ', $t)) }}</option>
                    @endforeach
                </select>
                
                <select wire:model="status" class="px-4 py-2 border rounded-md">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $s)
                        <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                
                <select wire:model="priority" class="px-4 py-2 border rounded-md">
                    <option value="">All Priorities</option>
                    @foreach($priorities as $p)
                        <option value="{{ $p }}">{{ ucfirst($p) }}</option>
                    @endforeach
                </select>
                
                <button wire:click="resetFilters" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">
                    Reset
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @forelse($notifications as $notification)
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2 py-1 text-xs rounded-md 
                                      {{ Str::contains($notification->type, 'birthday') ? 'bg-blue-100 text-blue-800' : '' }}
                                      {{ Str::contains($notification->type, 'wedding') ? 'bg-pink-100 text-pink-800' : '' }}
                                      {{ !Str::contains($notification->type, ['birthday', 'wedding']) ? 'bg-gray-100 text-gray-800' : '' }}">
                                      {{ ucwords(str_replace('_', ' ', $notification->type)) }}
                                  </span>
                              </td>
                              <td class="px-6 py-4">
                                  <div class="text-sm text-gray-900">{{ $notification->message }}</div>
                                  <div class="text-xs text-gray-500">
                                      @php
                                          $data = json_decode($notification->data, true);
                                          if (isset($data['user_id'])) {
                                              $user = \App\Models\User::find($data['user_id']);
                                              echo $user ? 'User: ' . $user->name : '';
                                          }
                                      @endphp
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2 py-1 text-xs rounded-md 
                                      {{ $notification->priority == 'high' ? 'bg-red-100 text-red-800' : '' }}
                                      {{ $notification->priority == 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                      {{ $notification->priority == 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                      {{ ucfirst($notification->priority) }}
                                  </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2 py-1 text-xs rounded-md 
                                      {{ $notification->status == 'pending' ? 'bg-blue-100 text-blue-800' : '' }}
                                      {{ $notification->status == 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                      {{ ucfirst($notification->status) }}
                                  </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  {{ $notification->created_at->format('M d, Y H:i') }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                  @if($notification->status == 'pending')
                                      <button wire:click="markAsResolved({{ $notification->id }})" class="text-green-600 hover:text-green-900">
                                          Mark as Resolved
                                      </button>
                                  @endif
                                  <button x-data x-on:click="$dispatch('open-modal', { id: 'view-notification-{{ $notification->id }}' })" class="ml-3 text-blue-600 hover:text-blue-900">
                                      View Details
                                  </button>
                              </td>
                          </tr>
                          
                          <!-- Modal for notification details -->
                          <div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail.id === 'view-notification-{{ $notification->id }}') open = true" x-on:close-modal.window="open = false" x-cloak>
                              <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                      <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                      
                                      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                      
                                      <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                              <div class="sm:flex sm:items-start">
                                                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                      <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                          Notification Details
                                                      </h3>
                                                      <div class="mt-4 space-y-3">
                                                          <div>
                                                              <span class="text-gray-500 text-sm">Type:</span>
                                                              <p>{{ ucwords(str_replace('_', ' ', $notification->type)) }}</p>
                                                          </div>
                                                          <div>
                                                              <span class="text-gray-500 text-sm">Message:</span>
                                                              <p>{{ $notification->message }}</p>
                                                          </div>
                                                          <div>
                                                              <span class="text-gray-500 text-sm">Data:</span>
                                                              <pre class="text-xs bg-gray-100 p-2 rounded mt-1 overflow-auto">{{ json_encode(json_decode($notification->data), JSON_PRETTY_PRINT) }}</pre>
                                                          </div>
                                                          <div>
                                                              <span class="text-gray-500 text-sm">Created:</span>
                                                              <p>{{ $notification->created_at->format('M d, Y H:i:s') }}</p>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                              <button type="button" @click="open = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                  Close
                                              </button>
                                              @if($notification->status == 'pending')
                                                  <button wire:click="markAsResolved({{ $notification->id }})" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                      Mark as Resolved
                                                  </button>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @empty
                          <tr>
                              <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                  No notifications found
                              </td>
                          </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
          
          <div class="mt-4">
              {{ $notifications->links() }}
          </div>
      </div>
      
      <script>
          window.addEventListener('notification-updated', event => {
              alert(event.detail.message);
          });
      </script>
  </div>
  