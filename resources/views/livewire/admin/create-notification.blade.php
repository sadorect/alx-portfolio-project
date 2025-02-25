<div>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="showForm"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto" x-show="showForm">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Broadcast New Notification</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                        <select wire:model="type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                            <option value="system">System</option>
                            <option value="email">Email</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                        <textarea 
                            wire:model="message" 
                            rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600"
                            placeholder="Enter notification message..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                        <select wire:model="priority" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                    <button 
                        wire:click="create" 
                        type="button" 
                        class="inline-flex w-full justify-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 sm:col-start-2">
                        Broadcast
                    </button>
                    <button 
                        wire:click="$set('showForm', false)" 
                        type="button" 
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
