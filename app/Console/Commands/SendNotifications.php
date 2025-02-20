<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send pending notifications that are due';

    public function handle()
    {
        Log::info('Checking for pending notifications...');

        // Get notifications that are due but not read
        $notifications = Notification::where('notified_at', '<=', Carbon::now())
                                     ->where('is_read', false)
                                     ->get();

        foreach ($notifications as $notification) {
            // Here, you can implement how the notification is sent (e.g., email, real-time update, etc.)
            Log::info("Sending notification to User {$notification->user_id}: {$notification->message}");

            // Mark the notification as read (optional: if you only want to send once)
            $notification->update(['is_read' => true]);
        }

        Log::info('Notifications processed successfully.');
    }
}
