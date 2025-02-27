<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CelebrantWishes extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $celebrant;
    public $message;
    public $eventType;
    public $user;

    public function __construct($celebrant, $message, $eventType, $user)
    {
        $this->celebrant = $celebrant;
        $this->message = $message;
        $this->eventType = $eventType;
        $this->user = $user;
    }

    public function build()
    {
        $subject = ($this->eventType == 'birthday') 
            ? "Happy Birthday, {$this->celebrant->name}!" 
            : "Happy Anniversary, {$this->celebrant->name}!";
        
        return $this->subject($subject)
                    ->markdown('emails.celebrant-wishes');
    }
}
