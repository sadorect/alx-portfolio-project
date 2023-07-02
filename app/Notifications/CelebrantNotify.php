<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CelebrantNotify extends Notification
{
    use Queueable;
private $upcomingWeddings;
private $upcomingBirthdays;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
       
        $today = Carbon::today();
        $endDate = $today->copy()->addDays(30);

        //$user = Auth::user();
        $user = Auth::user()->id; 
        $upcomingWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereRaw("DATE_FORMAT(wedding, '%m-%d') BETWEEN '{$today->format('m-d')}' AND '{$endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(wedding, '%m-%d')")
            ->get();

        $upcomingBirthdays = $user->anniversary()
        ->whereNotNull('birthday')
        ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN '{$today->format('m-d')}' AND '{$endDate->format('m-d')}'")
        ->orderByRaw("DATE_FORMAT(birthday, '%m-%d')")
        ->get();

        $this->upcomingBirthdays = $upcomingBirthdays;
        $this->upcomingWeddings = $upcomingWeddings;
       

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
     
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Upcoming Celebrants')
       // ->to($notifiable->email)
        ->line('Here are the upcoming celebrants for the week:')
        ->line('Birthdays:<br>')
        ->line($this->upcomingBirthdays)
        ->line('Wedding Anniversaries:<br>')
        ->line($this->upcomingWeddings)
        ->action('Notification Action', url('/'))
        ->line('Thank you for using MyAnniversary!');
                  
                    
    }*/

    public function toMail(object $notifiable): MailMessage
{  //$user = Auth::user();
    //dd($user); // Check if $user is null or contains a user object
    $upcomingBirthdays = $this->upcomingBirthdays;
    $upcomingWeddings = $this->upcomingWeddings;

    $birthdayLines = '';
    foreach ($this->upcomingBirthdays as $birthday) {
        $birthdayLines .=$birthday->name. "  -  " .$birthday->birthday. "<br />" ;
    }

    $weddingLines = '';
    foreach ($this->upcomingWeddings as $wedding) {
        $weddingLines .= $wedding->name. "  -  " .$wedding->wedding. "<br />";
    }

    return (new MailMessage)
        ->subject('Upcoming Celebrants')
        ->line('Here are the upcoming celebrants for the week:')
        ->line('Birthdays:')
        ->line($birthdayLines)
        ->line('Wedding Anniversaries:')
        ->line($weddingLines)
        ->action('Notification Action', url('/'))
        ->line('Thank you for using MyAnniversary!');
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
}
