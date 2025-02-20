<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        try {
            $notification = Notification::findOrFail($id);

            // Update the notification status to read
            $notification->is_read = true;
            $notification->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error marking notification as read: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to mark notification as read.'], 500);
        }
    }

    public function fetchNotifications(Request $request)
    {
        // Get the current date and time
        $now = now(); 
    
        // Fetch notifications that are due today or in the past, and are unread
        $notifications = Notification::where('user_id', Auth::id())
            ->where('notified_at', '<=', $now) // Check if the notification is due now or in the past
            ->where('is_read', false) // Only fetch unread notifications
            ->orderBy('notified_at', 'desc')
            ->get();
    
        return response()->json($notifications);
    }
    
}
