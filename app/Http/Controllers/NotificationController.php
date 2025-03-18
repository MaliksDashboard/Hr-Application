<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // public function markAsRead($id)
    // {
    //     try {
    //         $notification = Notification::findOrFail($id);

    //         // Update the notification status to read
    //         $notification->is_read = true;
    //         $notification->save();

    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         Log::error('Error marking notification as read: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Failed to mark notification as read.'], 500);
    //     }
    // }

    // public function fetchNotifications(Request $request)
    // {
    //     // Get the current date and time
    //     $now = now();

    //     // Fetch notifications that are due today or in the past, and are unread
    //     $notifications = Notification::where('user_id', Auth::id())
    //         ->where('notified_at', '<=', $now) // Check if the notification is due now or in the past
    //         ->where('is_read', false) // Only fetch unread notifications
    //         ->orderBy('notified_at', 'desc')
    //         ->get();

    //     return response()->json($notifications);
    // }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function fetchNotifications(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(Notification::where('user_id', Auth::id()) // Ensures user is logged in
            ->where('is_read', false)
            ->orderBy('notified_at', 'desc')
            ->get());
    }
}
