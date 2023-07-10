<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\CelebrantNotify;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $notificationData;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $notificationData)
    {
        $this->user = $user;
        $this->notificationData = $notificationData;
    }
 /**
     * Get the user for the job.
     *
     * @return \App\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->notificationData['user'];
        $upcomingWeddings = $this->notificationData['upcomingWeddings'] ?? [];
        $upcomingBirthdays = $this->notificationData['upcomingBirthdays'] ?? [];

        $notificationData = [
            'user' => $user,
            'upcomingWeddings' => $upcomingWeddings,
            'upcomingBirthdays' => $upcomingBirthdays,
        ];

       // $user = $this->getUser();
        Notification::send($this->user, new CelebrantNotify($this->notificationData));
    }
}
