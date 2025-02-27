<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Celebrant;

class TestNotificationCommand extends Command
{
    protected $signature = 'notifications:test {user? : The ID of the user to test} {type=all : The type of notification to test (birthday, wedding, or all)}';
    protected $description = 'Test the notification system by generating sample notifications';

    public function handle()
    {
        $userId = $this->argument('user');
        $type = $this->argument('type');
        
        $query = User::query();
        
        if ($userId) {
            $query->where('id', $userId);
        }
        
        $users = $query->get();
        
        if ($users->isEmpty()) {
            $this->error('No users found');
            return 1;
        }
        
        foreach ($users as $user) {
            $this->info("Processing test notifications for user: {$user->name}");
            
            // Create test celebrants with upcoming events
            $celebrant = $this->createTestCelebrant($user, $type);
            
            // Run the notification command
            $this->call('notifications:send-anniversary', [
                '--force' => true
            ]);
            
            $this->info("Test completed for user {$user->name}");
            
            // Clean up test data
            if ($celebrant) {
                $celebrant->delete();
                $this->info("Test celebrant removed");
            }
        }
        
        return 0;
    }
    
    private function createTestCelebrant($user, $type)
    {
        $today = now();
        
        $data = [
            'user_id' => $user->id,
            'name' => 'Test Celebrant',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'title' => 'Mr.',
        ];
        
        if ($type === 'birthday' || $type === 'all') {
            $data['birthday'] = $today->format('Y-m-d');
        }
        
        if ($type === 'wedding' || $type === 'all') {
            $data['wedding'] = $today->format('Y-m-d');
        }
        
        return Celebrant::create($data);
    }
}
