<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Models\Project;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $now = now();

    // Upcoming -> Active
    Project::where('status', 'upcoming')
        ->whereNotNull('start_time')
        ->where('start_time', '<=', $now)
        ->update(['status' => 'active']);

    // Active -> Completed (15 mins after end time)
    Project::where('status', 'active')
        ->whereNotNull('end_time')
        ->where('end_time', '<=', $now->copy()->subMinutes(15))
        ->update(['status' => 'completed']);
        
})->everyMinute();
