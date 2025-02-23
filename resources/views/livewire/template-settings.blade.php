<div>
    <form wire:submit.prevent="saveTemplates">
        <div class="space-y-4">
          <!-- Available Variables Guide -->
          <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="font-medium text-gray-900 mb-2">Available Variables</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="font-mono text-brand-600">{name}</span>
                    <span class="text-gray-600 ml-2">Full name</span>
                </div>
                <div>
                    <span class="font-mono text-brand-600">{title}</span>
                    <span class="text-gray-600 ml-2">Title (Mr/Mrs/Dr)</span>
                </div>
                <div>
                    <span class="font-mono text-brand-600">{age}</span>
                    <span class="text-gray-600 ml-2">Current age (birthdays only)</span>
                </div>
                <div>
                    <span class="font-mono text-brand-600">{years}</span>
                    <span class="text-gray-600 ml-2">Years married (anniversaries only)</span>
                </div>
                <div>
                    <span class="font-mono text-brand-600">{date}</span>
                    <span class="text-gray-600 ml-2">Event date</span>
                </div>
            </div>
        </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Birthday Message Template</label>
                <textarea 
                    wire:model="birthdayTemplate" 
                    rows="4" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500"
                    placeholder="Happy birthday {name}! Wishing you..."
                ></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Wedding Anniversary Template</label>
                <textarea 
                    wire:model="weddingTemplate" 
                    rows="4" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500"
                    placeholder="Happy anniversary {name}! Congratulations on..."
                ></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-brand-600 text-white px-4 py-2 rounded-lg hover:bg-brand-700">
                    Save Templates
                </button>
            </div>
        </div>
    </form>
</div>
