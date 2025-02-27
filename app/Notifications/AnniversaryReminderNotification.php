<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AnniversaryReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $celebrant;
    protected $eventType;
    protected $eventDate;
    protected $notificationType;

    public function __construct($celebrant, $eventType, $eventDate, $notificationType)
    {
        $this->celebrant = $celebrant;
        $this->eventType = $eventType;
        $this->eventDate = $eventDate;
        $this->notificationType = $notificationType;
    }

    public function via($notifiable)
    {
        //original: return ['mail', 'database'];
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $event = ($this->eventType == 'birthday') ? 'birthday' : 'wedding anniversary';
        $years = ($this->eventType == 'birthday') 
            ? $this->eventDate->year - \Carbon\Carbon::parse($this->celebrant->birthday)->year 
            : $this->eventDate->year - \Carbon\Carbon::parse($this->celebrant->wedding)->year;
            
        if ($this->notificationType == 'reminder') {
            $greeting = "Hello {$notifiable->name}!";
            $line1 = "This is a reminder that {$this->celebrant->name}'s {$event} is coming up on {$this->eventDate->format('F j')}.";
            $line2 = "Don't forget to wish them well on their special day!";
        } else {
            $greeting = "Hello {$notifiable->name}!";
            $line1 = "Today is {$this->celebrant->name}'s {$event}!";
            $line2 = $years > 0 ? "They are celebrating {$years} years today!" : "Make sure to send your wishes for their special day!";
        }

        return (new MailMessage)
            ->subject($this->getSubject())
            ->greeting($greeting)
            ->line($line1)
            ->line($line2)
            ->action('View Details', url('/celebrants'));
    }

    public function toDatabase($notifiable)
    {
        $event = ($this->eventType == 'birthday') ? 'birthday' : 'wedding anniversary';
        
        return [
            'message' => $this->getMessage(),
            'celebrant_id' => $this->celebrant->id,
            'event_type' => $this->eventType,
            'event_date' => $this->eventDate->toDateString(),
            'notification_type' => $this->notificationType,
        ];
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
    
    private function getMessage()
    {
        $event = ($this->eventType == 'birthday') ? 'birthday' : 'wedding anniversary';
        
        if ($this->notificationType == 'reminder') {
            return "{$this->celebrant->name}'s {$event} is coming up on {$this->eventDate->format('F j')}.";
        } else {
            return "Today is {$this->celebrant->name}'s {$event}!";
        }
    }
}
