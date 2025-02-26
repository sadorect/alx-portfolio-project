<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;

class SystemSettings extends Component
{
    public $timezone = 'UTC';
    public $date_format = 'Y-m-d';
    public $maintenance_mode = false;
    public $registration_enabled = true;
    public $default_language = 'en';
    
    public function mount()
    {
        $this->timezone = Setting::get('timezone', 'UTC');
        $this->date_format = Setting::get('date_format', 'Y-m-d');
        $this->maintenance_mode = Setting::get('maintenance_mode', false);
        $this->registration_enabled = Setting::get('registration_enabled', true);
        $this->default_language = Setting::get('default_language', 'en');
    }

    public function saveSettings()
    {
        Setting::set([
            'timezone' => $this->timezone,
            'date_format' => $this->date_format,
            'maintenance_mode' => $this->maintenance_mode,
            'registration_enabled' => $this->registration_enabled,
            'default_language' => $this->default_language
        ]);

        $this->dispatch('settingsSaved');
    }

    public function render()
    {
        return view('livewire.admin.system-settings');
    }
}
