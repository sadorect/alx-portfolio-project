<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class CreateNotification extends Component
{
    public $type = 'system';
    public $message;
    public $priority = 'low';
    public $showForm = false;

    protected $rules = [
        'type' => 'required|in:system,email,user',
        'message' => 'required|string|max:500',
        'priority' => 'required|in:low,medium,high'
    ];

    public function create()
    {
        $validated = $this->validate();
        
        Notification::create($validated);
        
        $this->reset();
        $this->showForm = false;
        
        $this->emit('notificationCreated');
    }

    public function render()
    {
        return view('livewire.admin.create-notification');
    }
}
