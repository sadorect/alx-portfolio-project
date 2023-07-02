<?php

namespace Tests;
use Carbon\Carbon;
use App\Models\User;
use DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CelebrantNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function testListCelebrantsNotification()
{
    // Mock the Mail facade
    Mail::fake();

    // Fetch the user and upcoming celebrants data
    $today = Carbon::today();
    $endDate = $today->copy()->addDays(7);
    // Enable database transactions for the test
    

    // Fetch the user from the database
    $user = User::find(1); // Replace 1 with the actual user ID

    
    $upcomingBirthdays = $user->anniversary()
        ->whereNotNull('birthday')
        ->whereBetween('birthday', [$today, $endDate])
        ->orderBy('birthday')
        ->get();

    // ...

        $upcomingWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereBetween('wedding', [$today, $endDate])
            ->orderBy('wedding')
            ->get();
    // Prepare the notification data
    $notificationData = [
        'upcomingBirthdays' => $upcomingBirthdays,
        'upcomingWeddings' => $upcomingWeddings,
    ];

    // Trigger the notification
    $user->notify(new CelebrantNotify($notificationData));

    // Assert that the notification was sent
    Mail::assertSent(CelebrantNotify::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
}

}
