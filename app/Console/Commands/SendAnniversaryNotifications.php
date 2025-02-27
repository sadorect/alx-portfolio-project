<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Celebrant;
use App\Models\Notification;
use App\Mail\CelebrantWishes;
use Illuminate\Console\Command;
use App\Mail\AnniversaryReminder;
use App\Services\TemplateProcessor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AnniversaryReminderNotification;

class SendAnniversaryNotifications extends Command
{
    protected $signature = 'notifications:send-anniversary {--force : Force sending notifications regardless of time}{--today-only : Only send for today\'s events, skipping upcoming}';
    protected $description = 'Send anniversary and birthday notifications based on user preferences';

    public function handle()
    {
        $this->info('Starting anniversary notification process...');
        
        // Get current date and time
        $now = Carbon::now();
        $currentTime = $now->format('H:i');
        
        // For testing with --force, we'll skip the time check
        $forceMode = $this->option('force');
        
        // Get system-wide settings
        $systemDefaultDaysBefore = \App\Models\Setting::get('reminder_days_before', 3);
        $systemDefaultTime = \App\Models\Setting::get('reminder_time', '09:00');
        $systemNotificationTypes = \App\Models\Setting::get('notification_types', [
            'email' => true,
            'database' => true,
            'sms' => false
        ]);
        
        // Process only if we're within 5 minutes of the scheduled time or if force mode
        if ($forceMode || $this->isWithinScheduledTime($currentTime, $systemDefaultTime)) {
            $this->processAllUsers($now, $systemDefaultDaysBefore, $systemDefaultTime, $systemNotificationTypes);
        } else {
            $this->info("Current time ($currentTime) is not within the scheduled notification window. Skipping.");
        }
        
        $this->info('Anniversary notification process completed.');
        
        return 0;
    }
    
    private function processAllUsers($now, $systemDefaultDaysBefore, $systemDefaultTime, $systemNotificationTypes)
    {
        // Process for each user
        User::chunk(50, function ($users) use ($now, $systemDefaultDaysBefore, $systemDefaultTime, $systemNotificationTypes) {
            foreach ($users as $user) {
                $this->info("Processing notifications for user: {$user->name}");
                
                // Get user settings or fall back to system defaults
                $userSettings = $user->settings;

                 // Use existing properties with fallbacks to system defaults
                $daysBeforeNotification = $userSettings ? $userSettings->days_before : $systemDefaultDaysBefore;

                 // Handle time format correctly for the time data type
                $notificationTime = $userSettings ? $userSettings->notification_time : $systemDefaultTime;
                 // If notification_time is a Carbon instance or formatted differently, ensure it's in "HH:MM" format
                if ($notificationTime instanceof \Carbon\Carbon) {
                  $notificationTime = $notificationTime->format('H:i');
                }
                // Determine which notification channels to use
                $useEmail = $userSettings ? $userSettings->email_enabled : $systemNotificationTypes['email'];
                $useSms = $userSettings ? $userSettings->sms_enabled : $systemNotificationTypes['sms'];
                
                // Get user's celebration templates
                $birthdayTemplate = $userSettings ? $userSettings->birthday_template : null;
                $weddingTemplate = $userSettings ? $userSettings->wedding_template : null;
                
                // Get user's celebrants
                $celebrants = $user->celebrants;
                
                foreach ($celebrants as $celebrant) {
                    // Process birthdays
                    if ($celebrant->birthday) {
                        $this->processBirthday(
                            $user, 
                            $celebrant, 
                            $now, 
                            $daysBeforeNotification, 
                            $notificationTime,
                            $useEmail,
                            $useSms,
                            $birthdayTemplate
                        );
                    }
                    
                    // Process wedding anniversaries
                    if ($celebrant->wedding) {
                        $this->processAnniversary(
                            $user, 
                            $celebrant, 
                            $now, 
                            $daysBeforeNotification, 
                            $notificationTime,
                            $useEmail,
                            $useSms,
                            $weddingTemplate
                        );
                    }
                }
            }
        });
    }
    
    private function processBirthday($user, $celebrant, $now, $daysBeforeNotification, $notificationTime, $useEmail, $useSms, $template)
    {
        // Calculate this year's birthday
        $birthdayThisYear = Carbon::parse($celebrant->birthday)->setYear($now->year);
        
        // If birthday has passed this year, use next year's
        if ($birthdayThisYear->lt($now)) {
            $birthdayThisYear->addYear();
        }
        
        // Calculate reminder date (X days before birthday)
        $reminderDate = (clone $birthdayThisYear)->subDays($daysBeforeNotification);
        
        // Check if today is the reminder date
        if ($now->isSameDay($reminderDate)) {
            $this->sendReminderNotification(
                $user,
                $celebrant,
                'birthday',
                $birthdayThisYear,
                $useEmail,
                $useSms,
                'reminder'
            );
        }
        
        // Check if today is the actual birthday
        if ($now->isSameDay($birthdayThisYear)) {
            // Send notification to user
            $this->sendReminderNotification(
                $user,
                $celebrant,
                'birthday',
                $birthdayThisYear,
                $useEmail,
                $useSms,
                'today'
            );
            
            // Send wishes to celebrant if they have an email
            if ($celebrant->email) {
                $this->sendCelebrantWishes(
                    $user,
                    $celebrant,
                    'birthday',
                    $birthdayThisYear,
                    $template
                );
            }
        }
    }
    
    private function processAnniversary($user, $celebrant, $now, $daysBeforeNotification, $notificationTime, $useEmail, $useSms, $template)
    {
        // Calculate this year's anniversary
        $anniversaryThisYear = Carbon::parse($celebrant->wedding)->setYear($now->year);
        
        // If anniversary has passed this year, use next year's
        if ($anniversaryThisYear->lt($now)) {
            $anniversaryThisYear->addYear();
        }
        
        // Calculate reminder date (X days before anniversary)
        $reminderDate = (clone $anniversaryThisYear)->subDays($daysBeforeNotification);
        
        // Check if today is the reminder date
        if ($now->isSameDay($reminderDate)) {
            $this->sendReminderNotification(
                $user,
                $celebrant,
                'wedding',
                $anniversaryThisYear,
                $useEmail,
                $useSms,
                'reminder'
            );
        }
        
        // Check if today is the actual anniversary
        if ($now->isSameDay($anniversaryThisYear)) {
            // Send notification to user
            $this->sendReminderNotification(
                $user,
                $celebrant,
                'wedding',
                $anniversaryThisYear,
                $useEmail,
                $useSms,
                'today'
            );
            
            // Send wishes to celebrant if they have an email
            if ($celebrant->email) {
                $this->sendCelebrantWishes(
                    $user,
                    $celebrant,
                    'wedding',
                    $anniversaryThisYear,
                    $template
                );
            }
        }
    }
    
    private function sendReminderNotification($user, $celebrant, $type, $date, $useEmail, $useSms, $notificationType)
    {
      // Add explicit logging
    Log::info("Attempting to send notification", [
      'user_id' => $user->id,
      'celebrant_id' => $celebrant->id,
      'type' => $type,
      'useEmail' => $useEmail,
      'useSms' => $useSms,
      'notificationType' => $notificationType
  ]);
        // Check if notification was already sent (to avoid duplicates)
        $uniqueIdentifier = md5($user->id . $celebrant->id . $type . $date->toDateString() . $notificationType);
        
        if ($this->notificationWasSent($uniqueIdentifier)) {
            $this->info("Notification already sent for {$celebrant->name}'s {$type} ({$notificationType})");
            return;
        }
        
        $notificationText = $this->buildNotificationText($celebrant, $type, $date, $notificationType);
        
        // Log the notification in the database
        $notification = new Notification();
        $notification->type = $type . '_' . $notificationType;
        $notification->message = $notificationText;
        $notification->priority = ($notificationType == 'today') ? 'high' : 'medium';
        $notification->status = 'pending';
        $notification->data = json_encode([
            'user_id' => $user->id,
            'celebrant_id' => $celebrant->id,
            'date' => $date->toDateString(),
            'unique_id' => $uniqueIdentifier
        ]);
        $notification->save();
        
        // Send email notification if enabled
        if ($useEmail) {
          try {
            Log::info("About to send email notification to {$user->email}");
            $user->notify(new AnniversaryReminderNotification($celebrant, $type, $date, $notificationType));
            Log::info("Email notification sent successfully to {$user->email}");
        } catch (\Exception $e) {
            Log::error("Failed to send email: " . $e->getMessage(), [
                'exception' => $e,
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            $this->error("Failed to send email: " . $e->getMessage());
        }
        }
        
        // Send SMS notification if enabled (would require integration with SMS service)
        if ($useSms && $user->phone) {
            // SMS implementation would go here
            $this->info("SMS notification would be sent to {$user->phone} (not implemented)");
        }
        
        // Log the activity
        $user->logActivity(
            'notification_sent',
            "Notification sent for {$celebrant->name}'s {$type}",
            [
                'celebrant_id' => $celebrant->id,
                'event_type' => $type,
                'notification_type' => $notificationType,
                'date' => $date->toDateString()
            ]
        );
    }
    
    private function sendCelebrantWishes($user, $celebrant, $type, $date, $template)
    {
        // Check if wishes were already sent (to avoid duplicates)
        $uniqueIdentifier = md5($user->id . $celebrant->id . $type . $date->toDateString() . 'wishes');
        
        if ($this->notificationWasSent($uniqueIdentifier)) {
            $this->info("Wishes already sent to {$celebrant->name} for their {$type}");
            return;
        }
        
        // Process the message template
        $message = ($type == 'birthday') 
            ? TemplateProcessor::processBirthdayTemplate($celebrant, $template)
            : TemplateProcessor::processWeddingTemplate($celebrant, $template);
            
        try {
            // Send email to celebrant
            Mail::to($celebrant->email)
                ->send(new CelebrantWishes($celebrant, $message, $type, $user));
                
            // Log the notification
            $notification = new Notification();
            $notification->type = $type . '_wishes';
            $notification->message = "Wishes sent to {$celebrant->name} for their {$type}";
            $notification->priority = 'medium';
            $notification->status = 'resolved';
            $notification->data = json_encode([
                'user_id' => $user->id,
                'celebrant_id' => $celebrant->id,
                'date' => $date->toDateString(),
                'unique_id' => $uniqueIdentifier,
                'message' => $message
            ]);
            $notification->save();
            
            // Log the activity
            $user->logActivity(
                'wishes_sent',
                "Wishes sent to {$celebrant->name} for their {$type}",
                [
                    'celebrant_id' => $celebrant->id,
                    'event_type' => $type,
                    'date' => $date->toDateString(),
                    'message' => $message
                ]
            );
            
            $this->info("Wishes sent to {$celebrant->email} for their {$type}");
        } catch (\Exception $e) {
            $this->error("Failed to send wishes: " . $e->getMessage());
        }
    }
    
    private function buildNotificationText($celebrant, $type, $date, $notificationType)
    {
        $event = ($type == 'birthday') ? 'birthday' : 'wedding anniversary';
        $years = ($type == 'birthday') 
            ? $date->year - Carbon::parse($celebrant->birthday)->year 
            : $date->year - Carbon::parse($celebrant->wedding)->year;
            
        if ($notificationType == 'reminder') {
            return "Reminder: {$celebrant->name}'s {$event} is coming up on {$date->format('F j')}";
        } else {
            return "Today is {$celebrant->name}'s {$event}! " . ($years > 0 ? "They are celebrating {$years} years today!" : "");
        }
    }
    
    private function notificationWasSent($uniqueIdentifier)
    {
        return Notification::where('data', 'like', '%"unique_id":"' . $uniqueIdentifier . '"%')->exists();
    }
    
    private function isWithinScheduledTime($currentTime, $scheduledTime)
    {
          // Handle potential Carbon instances or different time formats
        if ($scheduledTime instanceof \Carbon\Carbon) {
          $scheduledTime = $scheduledTime->format('H:i');
          }
        // Parse the times
        $current = Carbon::createFromFormat('H:i', $currentTime);
        $scheduled = Carbon::createFromFormat('H:i', $scheduledTime);
        
        // Allow 5 minutes before and after the scheduled time
        $startWindow = (clone $scheduled)->subMinutes(5);
        $endWindow = (clone $scheduled)->addMinutes(5);
        
        return $current->between($startWindow, $endWindow);
    }
}
