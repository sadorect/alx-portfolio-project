<x-layouts.dashboard>
  <x-slot name="header">
      Manage Celebrants
  </x-slot>

  <div class="mb-6">
      <a href="{{ route('celebrants.create') }}" class="bg-brand-600 text-white px-4 py-2 rounded-lg hover:bg-brand-700">
          <i class="fas fa-plus mr-2"></i> Add Celebrant
      </a>
  </div>

  <livewire:celebrants-list />
</x-layouts.dashboard>
