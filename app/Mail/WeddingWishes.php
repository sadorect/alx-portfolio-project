<?php

namespace App\Mail;

use App\Models\Celebrant;
use App\Services\TemplateProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeddingWishes extends Mailable
{
    use Queueable, SerializesModels;

    public $celebrant;
    public $message;

    public function __construct(Celebrant $celebrant)
    {
        $this->celebrant = $celebrant;
        $this->message = TemplateProcessor::processWeddingTemplate(
            $celebrant,
            $celebrant->user->settings->wedding_template ?? null
        );
    }

    public function build()
    {
        return $this->markdown('emails.wedding-wishes')
                    ->subject('Happy Wedding Anniversary ' . $this->celebrant->name);
    }
}
