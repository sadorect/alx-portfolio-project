<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TemplateSettings extends Component
{
    public $birthdayTemplate;
    public $weddingTemplate;

    public function mount()
    {
        $settings = auth()->user()->settings;
        if ($settings) {
            $this->birthdayTemplate = $settings->birthday_template;
            $this->weddingTemplate = $settings->wedding_template;
        }
    }

    public function saveTemplates()
    {
        auth()->user()->settings()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'birthday_template' => $this->birthdayTemplate,
                'wedding_template' => $this->weddingTemplate,
            ]
        );

        auth()->user()->logActivity(
            'template_updated',
            'Updated message templates',
            [
                'birthday_template' => $this->birthdayTemplate,
                'wedding_template' => $this->weddingTemplate
            ]
        );
        
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.template-settings');
    }
}
