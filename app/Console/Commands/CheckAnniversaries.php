<?php

namespace App\Console\Commands;

use App\Models\Celebrant;
use App\Mail\WeddingWishes;
use App\Mail\BirthdayWishes;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckAnniversaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:anniversaries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send emails for birthdays and wedding anniversaries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now();
        
        // Check birthdays
        $birthdays = Celebrant::whereMonth('birthday', $today->month)
            ->whereDay('birthday', $today->day)
            ->with('user')
            ->get();

        // Check weddings
        $weddings = Celebrant::whereMonth('wedding', $today->month)
            ->whereDay('wedding', $today->day)
            ->with('user')
            ->get();

        foreach($birthdays as $celebrant) {
            Mail::to($celebrant->email)
                ->send(new BirthdayWishes($celebrant));

                $celebrant->user->logActivity(
                    'wish_sent',
                    "Sent birthday wishes to {$celebrant->name}",
                    ['celebrant_id' => $celebrant->id, 'type' => 'birthday']
                );

        }

        foreach($weddings as $celebrant) {
            Mail::to($celebrant->email)
                ->send(new WeddingWishes($celebrant));

                $celebrant->user->logActivity(
                    'wish_sent',
                    "Sent wedding anniversary wishes to {$celebrant->name}",
                    ['celebrant_id' => $celebrant->id, 'type' => 'wedding']
                );

        }
    }
}
