<?php

namespace App\Mail;

use App\Models\Celebrant;
use App\Services\TemplateProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BirthdayWishes extends Mailable
{
    use Queueable, SerializesModels;

    public $celebrant;
    public $message;

    public function __construct(Celebrant $celebrant)
    {
        $this->celebrant = $celebrant;
        $this->message = TemplateProcessor::processBirthdayTemplate(
            $celebrant,
            $celebrant->user->settings->birthday_template ?? null
        );
    }

    public function build()
    {
        return $this->markdown('emails.birthday-wishes')
                    ->subject('Happy Birthday ' . $this->celebrant->name);
    }
}
