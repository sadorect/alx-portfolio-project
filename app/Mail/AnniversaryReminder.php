<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class AnniversaryReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $celebrant;
    public $eventType;
    public $eventDate;
    public $notificationType;

    public function __construct($celebrant, $eventType, $eventDate, $notificationType)
    {
        $this->celebrant = $celebrant;
        $this->eventType = $eventType;
        $this->eventDate = $eventDate;
        $this->notificationType = $notificationType;
    }

    public function build()
    {
        $subject = $this->getSubject();
        
        return $this->subject($subject)
                    ->markdown('emails.anniversary-reminder');
    }
    
    private function getSubject()
    {
        $event = ($this->eventType == 'birthday') ? 'Birthday' : 'Wedding Anniversary';
        
        if ($this->notificationType == 'reminder') {
            return "Upcoming {$event}: {$this->celebrant->name} on {$this->eventDate->format('F j')}";
        } else {
            return "Today is {$this->celebrant->name}'s {$event}!";
        }
    }
}
