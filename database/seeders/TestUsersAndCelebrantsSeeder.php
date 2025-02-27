<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Celebrant;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestUsersAndCelebrantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating 5 test users with celebrants...');
        
        // Create 5 test users
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Test User {$i}",
                'email' => "testuser{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Default password for all test users
                'remember_token' => Str::random(10),
            ]);
            
            $this->command->info("Created user: {$user->name} ({$user->email})");
            
            // Create user settings with templates
            UserSetting::create([
                'user_id' => $user->id,
                'email_enabled' => true,
                'sms_enabled' => rand(0, 1) == 1, // Randomly enable/disable SMS
                'days_before' => rand(1, 7), // Random days before (1-7)
                'notification_time' => sprintf('%02d:00', rand(8, 18)), // Random hour between 8 AM and 6 PM
                'birthday_template' => "Happy birthday {name}! Celebrating your {age} years of amazing life. Best wishes from {$user->name}.",
                'wedding_template' => "Happy anniversary {name}! Congratulations on {years} years of marriage. Best wishes from {$user->name}.",
            ]);
            
            // Create 5 celebrants for each user with events in the next 3 days
            for ($j = 1; $j <= 5; $j++) {
                // Determine which date(s) to set - both, birthday only, or wedding only
                $setBirthday = rand(0, 10) > 3; // 70% chance of setting birthday
                $setWedding = rand(0, 10) > 3;  // 70% chance of setting wedding
                
                // Ensure at least one date is set
                if (!$setBirthday && !$setWedding) {
                    $setBirthday = true;
                }
                
                // Generate random days offset (0, 1, or 2) for the next 3 days
                $birthdayOffset = rand(0, 2);
                $weddingOffset = rand(0, 2);
                
                // Calculate dates
                $birthdayDate = null;
                $weddingDate = null;
                
                if ($setBirthday) {
                    // Set birthday to be in the next 0-2 days, with random year in the past
                    $birthdayYear = rand(1950, 2000);
                    $birthdayDate = Carbon::now()->addDays($birthdayOffset)->setYear($birthdayYear)->format('Y-m-d');
                }
                
                if ($setWedding) {
                    // Set wedding to be in the next 0-2 days, with random year in the past
                    $weddingYear = rand(1970, 2020);
                    $weddingDate = Carbon::now()->addDays($weddingOffset)->setYear($weddingYear)->format('Y-m-d');
                }
                
                $celebrant = Celebrant::create([
                    'user_id' => $user->id,
                    'name' => "Celebrant {$j} of User {$i}",
                    'email' => "celebrant{$j}user{$i}@example.com",
                    'phone' => "555-" . rand(100, 999) . "-" . rand(1000, 9999),
                    'title' => rand(0, 1) ? 'Mr.' : 'Mrs.',
                    'birthday' => $birthdayDate,
                    'wedding' => $weddingDate,
                    'notes' => "Test notes for celebrant {$j}",
                ]);
                
                $celebrationTypes = [];
                if ($birthdayDate) {
                    $age = Carbon::parse($birthdayDate)->age;
                    $celebrationTypes[] = "birthday on " . Carbon::now()->addDays($birthdayOffset)->format('M d') . " (turning {$age})";
                }
                if ($weddingDate) {
                    $years = Carbon::now()->year - Carbon::parse($weddingDate)->year;
                    $celebrationTypes[] = "wedding anniversary on " . Carbon::now()->addDays($weddingOffset)->format('M d') . " ({$years} years)";
                }
                
                $this->command->info("  - Created celebrant: {$celebrant->name} with " . implode(' and ', $celebrationTypes));
            }
        }
        
        $this->command->info('Seeding completed successfully!');
    }
}
