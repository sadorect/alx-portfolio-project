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

    public function render()
    {
        $notifications = Notification::query()
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->priority, fn($q) => $q->where('priority', $this->priority))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.notifications-list', [
            'notifications' => $notifications
        ]);
    }
}
