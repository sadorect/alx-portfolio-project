<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
  <h2 class="text-xl font-semibold mb-6">Email Configuration</h2>

  <form wire:submit.prevent="saveSettings" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- SMTP Settings -->
          <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
              <h3 class="text-lg font-medium border-b pb-2">SMTP Settings</h3>
              
              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SMTP Host</label>
                  <input type="text" wire:model="smtp_host" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('smtp_host') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SMTP Port</label>
                  <input type="text" wire:model="smtp_port" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('smtp_port') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SMTP Username</label>
                  <input type="text" wire:model="smtp_username" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('smtp_username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SMTP Password</label>
                  <input type="password" wire:model="smtp_password" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('smtp_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Encryption</label>
                  <select wire:model="encryption" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                      <option value="tls">TLS</option>
                      <option value="ssl">SSL</option>
                  </select>
              </div>
          </div>

          <!-- Sender Settings -->
          <div class="space-y-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
              <h3 class="text-lg font-medium border-b pb-2">Sender Information</h3>
              
              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Name</label>
                  <input type="text" wire:model="mail_from_name" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('mail_from_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Email Address</label>
                  <input type="email" wire:model="mail_from_address" class="mt-1 block w-full rounded-lg shadow-sm border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                  @error('mail_from_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
              </div>
          </div>
      </div>

      <div class="flex justify-between pt-6">
          <button type="button" 
              wire:click="testEmail" 
              class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 shadow-sm transition duration-150 hover:shadow focus:outline-none focus:ring-2 focus:ring-gray-400">
              Test Email Settings
          </button>

          <button type="submit" 
              class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 shadow-sm transition duration-150 hover:shadow focus:outline-none focus:ring-2 focus:ring-purple-500">
              Save Settings
          </button>
      </div>
  </form>

  <!-- Add notification handling -->
  <div x-data="{ notification: false, message: '', status: '' }" 
       x-on:email-tested.window="notification = true; message = $event.detail.message; status = $event.detail.status"
       class="fixed top-4 right-4 z-50">
      <div x-show="notification" 
           x-transition 
           x-init="setTimeout(() => notification = false, 3000)"
           class="p-4 rounded-lg shadow-lg"
           :class="status === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
          <p x-text="message"></p>
      </div>
  </div>
</div>
