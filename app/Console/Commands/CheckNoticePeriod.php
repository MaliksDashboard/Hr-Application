<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckNoticePeriod extends Command
{
    protected $signature = 'check:notice-period';
    protected $description = 'Check notice periods for employees and send notifications';

    public function handle()
    {
        // ✅ Fetch the URL every day
        $response = Http::get(url('/test-notice-period'));

        if ($response->successful()) {
            $this->info("Notice period check completed successfully.");
        } else {
            $this->error("Failed to fetch notice period check. Status: " . $response->status());
        }
    }
}
