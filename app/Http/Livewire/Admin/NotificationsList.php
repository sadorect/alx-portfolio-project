<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationsList extends Component
{
    use WithPagination;

    public $type = '';
    public $status = '';
    public $priority = '';
    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'type' => ['except' => ''],
        'status' => ['except' => ''],
        'priority' => ['except' => ''],
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];
    

    public function render()
    {
        $notifications = Notification::query()
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->priority, fn($q) => $q->where('priority', $this->priority))
            ->when($this->search, function($q) {
                return $q->where('message', 'like', '%' . $this->search . '%')
                         ->orWhere('data', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.notifications-list', [
            'notifications' => $notifications,
            'types' => Notification::select('type')->distinct()->pluck('type'),
            'statuses' => Notification::select('status')->distinct()->pluck('status'),
            'priorities' => Notification::select('priority')->distinct()->pluck('priority'),
        ]);
    }
    
    public function markAsResolved($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->status = 'resolved';
        $notification->save();
        
        $this->dispatch('notification-updated', ['message' => 'Notification marked as resolved.']);
    }
    
    public function resetFilters()
    {
        $this->reset(['type', 'status', 'priority', 'search']);
        $this->resetPage();
    }
}
