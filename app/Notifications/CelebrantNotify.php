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
        $today = Carbon::today();
        $endDate = $today->copy()->addDays(30);

        $userid = $this->getUser()->id;
        //$user1 = Auth::user()->id;
        $user = User::find($userid); 
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
     
   */

    public function toMail(object $notifiable): MailMessage
{  //$user = Auth::user();
    //dd($user); // Check if $user is null or contains a user object
    $user = $this->getUser();
    $upcomingBirthdays = $this->upcomingBirthdays;
    $upcomingWeddings = $this->upcomingWeddings;

    $birthdayLines =[];
    foreach ($this->upcomingBirthdays as $key => $birthday) {
        $birthdayLines[] .=++$key.".  ".$birthday->name. "  -  ".$birthday->phone."  -  " .Carbon::parse($birthday->birthday)->format('F jS');
    }

    $weddingLines = [];
    foreach ($this->upcomingWeddings as $key => $wedding) {
        $weddingLines[] .=++$key." -> ". $wedding->name. " -> " .$wedding->phone. " -> " .Carbon::parse($wedding->weddingy)->format('F jS');
    }
   
    $mail = (new MailMessage)
    ->subject('Upcoming Celebrants')
    ->greeting('Hello, ' . $user->name)
    ->line('Here are the upcoming celebrants for the week:')  
    ->line('Birthdays:');

foreach($birthdayLines as $line) {
    $mail->line($line);
}

$mail->line('Wedding Anniversaries:');
foreach($weddingLines as $line) {
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
