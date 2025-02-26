<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;

class NotificationSettings extends Component
{
  use \Livewire\WithPagination;
    use \Livewire\WithFileUploads;
    //use \App\Traits\WithSorting;

    public $reminder_days_before = 3;
    public $batch_size = 50;
    public $notification_types = [
        'email' => true,
        'database' => true,
        'sms' => false
    ];
    public $reminder_time = '09:00';
    
    public function mount()
    {
        $this->reminder_days_before = Setting::get('reminder_days_before', 3);
        $this->batch_size = Setting::get('notification_batch_size', 50);
        $this->notification_types = Setting::get('notification_types', $this->notification_types);
        $this->reminder_time = Setting::get('reminder_time', '09:00');
    }

    public function saveSettings()
    {
        Setting::set([
            'reminder_days_before' => $this->reminder_days_before,
            'notification_batch_size' => $this->batch_size,
            'notification_types' => $this->notification_types,
            'reminder_time' => $this->reminder_time
        ]);

        $this->dispatch('settingsSaved');
    }

    public function render()
    {
        return view('livewire.admin.notification-settings');
    }
}
