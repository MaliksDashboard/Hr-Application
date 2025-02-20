<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the authenticated user

        $lastMessages = Message::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('messages')
                ->groupBy('receiver_id', 'sender_id'); // Group by both sender and receiver
        })
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc') // Sort by most recent messages
            ->get()
            ->keyBy(function ($message) {
                return $message->sender_id === Auth::id() ? $message->receiver_id : $message->sender_id;
            });

        // Preselect the most recent chat
        $mostRecentUserId = $lastMessages->keys()->first(); // Get the first user based on recent messages
        $receiver = $request->has('receiver_id')
            ? User::find($request->receiver_id)
            : ($mostRecentUserId ? User::find($mostRecentUserId) : null);

        return view('chat.index', compact('users', 'lastMessages', 'receiver', 'mostRecentUserId'));
    }

    public function fetchMessages(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $messages = Message::with('sender') // Eager load sender
            ->where(function ($query) use ($request) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $request->receiver_id);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->receiver_id)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
    // Send a new message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);

            broadcast(new MessageSent($message))->toOthers();

            return response()->json($message);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
