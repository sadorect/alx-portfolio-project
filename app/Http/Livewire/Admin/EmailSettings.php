<?php

namespace App\Http\Livewire\Admin;

use App\Mail\TestEmail;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class EmailSettings extends Component
{
    public $smtp_host;
    public $smtp_port;
    public $smtp_username;
    public $smtp_password;
    public $mail_from_name;
    public $mail_from_address;
    public $encryption;

    public function mount()
    {
        $this->smtp_host = Setting::get('smtp_host');
        $this->smtp_port = Setting::get('smtp_port', '587');
        $this->smtp_username = Setting::get('smtp_username');
        $this->smtp_password = Setting::get('smtp_password');
        $this->mail_from_name = Setting::get('mail_from_name', config('app.name'));
        $this->mail_from_address = Setting::get('mail_from_address');
        $this->encryption = Setting::get('mail_encryption', 'tls');
    }

    public function saveSettings()
    {
        Setting::set([
            'smtp_host' => $this->smtp_host,
            'smtp_port' => $this->smtp_port,
            'smtp_username' => $this->smtp_username,
            'smtp_password' => $this->smtp_password,
            'mail_from_name' => $this->mail_from_name,
            'mail_from_address' => $this->mail_from_address,
            'mail_encryption' => $this->encryption
        ]);

        $this->emit('settingsSaved');
    }

    public function testEmail()
{
  $this->validate([
    'smtp_host' => 'required|string',
    'smtp_port' => 'required|numeric',
    'smtp_username' => 'required|string',
    'smtp_password' => 'required|string',
    'mail_from_address' => 'required|email',
    'mail_from_name' => 'required|string',
]);
    try {
        $testEmailAddress = auth()->user()->email;
        
        // Update mail config with current settings
        config([
            'mail.mailers.smtp.host' => $this->smtp_host,
            'mail.mailers.smtp.port' => $this->smtp_port,
            'mail.mailers.smtp.username' => $this->smtp_username,
            'mail.mailers.smtp.password' => $this->smtp_password,
            'mail.mailers.smtp.encryption' => $this->encryption,
            'mail.from.address' => $this->mail_from_address,
            'mail.from.name' => $this->mail_from_name,
        ]);

        Mail::to($testEmailAddress)->send(new TestEmail());

        $this->emit('emailTested', ['status' => 'success', 'message' => 'Test email sent successfully!']);
    } catch (\Exception $e) {
        $this->emit('emailTested', ['status' => 'error', 'message' => 'Failed to send test email: ' . $e->getMessage()]);
    }
}


    public function render()
    {
        return view('livewire.admin.email-settings');
    }
}
