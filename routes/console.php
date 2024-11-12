<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $waktu24JamLalu = Carbon::now()->subHours(24);
    DB::table('notifications')->where('created_at', '<', $waktu24JamLalu)->delete();
})->hourly();