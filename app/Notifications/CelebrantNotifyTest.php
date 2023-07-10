<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CelebrantNotify extends Notification
{
    use Queueable;
    private $notificationData;
private $upcomingWeddings;
private $upcomingBirthdays;
    /**
     * Create a new notification instance.
     */
    public function __construct($notificationData)
    {
        //
        $this->notificationData = $notificationData;
        
       

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     
   */

   public function toMail($notifiable)
   {
      // $user = $notifiable;
       $user = $this->notificationData['user'];
        $upcomingWeddings = $this->notificationData['upcomingWeddings'];
   
       $upcomingBirthdays = $this->upcomingBirthdays;
       $upcomingWeddings = $this->upcomingWeddings;
   
       $birthdayLines = [];
       foreach ($upcomingBirthdays as $key => $birthday) {
           $birthdayLines[] = ++$key . ". " . $birthday->name . " - " . $birthday->phone . " - " . Carbon::parse($birthday->birthday)->format('F jS');
       }
   
       $weddingLines = [];
       foreach ($upcomingWeddings as $key => $wedding) {
           $weddingLines[] = ++$key . " -> " . $wedding->name . " -> " . $wedding->phone . " -> " . Carbon::parse($wedding->weddingy)->format('F jS');
       }
   
       $mail = (new MailMessage)
           ->subject('Upcoming Celebrants')
           ->greeting('Hello, ' . $user->name)
           ->line('Here are the upcoming celebrants for the week:')
           ->line('Birthdays:');
   
       foreach ($birthdayLines as $line) {
           $mail->line($line);
       }
   
       $mail->line('Wedding Anniversaries:');
   
       foreach ($weddingLines as $line) {
           $mail->line($line);
       }
   
       $mail->action('Celebrate!!!', url('/'))
           ->line('Thank you for using MyAnniversary!');
   
       return $mail;
   }
   


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

     /**
     * Get the user for the notification.
     *
     * @return \App\User
     */
    public function getUser()
    {
        return $this->notificationData['user'];
    }
}
