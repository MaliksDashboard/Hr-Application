<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Event::create([
            'title' => 'Meeting',
            'start' => '2025-01-15 10:00:00',
            'end' => '2025-01-15 12:00:00',
        ]);

        Event::create([
            'title' => 'Conference',
            'start' => '2025-01-18 09:00:00',
            'end' => '2025-01-18 17:00:00',
        ]);
    }
}
