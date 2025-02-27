<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationSettings extends Component
{
    public $emailEnabled = true;
    public $smsEnabled = false;
    public $daysBeforeNotification = 7;
    public $notificationTime = "09:00";

    public function mount()
    {
        $settings = auth()->user()->settings;
        if ($settings) {
            $this->emailEnabled = $settings->email_enabled;
            $this->smsEnabled = $settings->sms_enabled;
            $this->daysBeforeNotification = $settings->days_before;
            $this->notificationTime = $settings->notification_time;
        }
    }

    public function saveSettings()
    {
        auth()->user()->settings()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'email_enabled' => $this->emailEnabled,
                'sms_enabled' => $this->smsEnabled,
                'days_before' => $this->daysBeforeNotification,
                'notification_time' => $this->notificationTime,
            ]
        );

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.notification-settings');
    }
}
