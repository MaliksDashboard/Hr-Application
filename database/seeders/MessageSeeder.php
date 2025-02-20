<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $sender) {
            foreach ($users as $receiver) {
                if ($sender->id !== $receiver->id) {
                    Message::create([
                        'sender_id' => $sender->id,
                        'receiver_id' => $receiver->id,
                        'message' => 'Hello from ' . $sender->name,
                    ]);
                }
            }
        }
    }
}
