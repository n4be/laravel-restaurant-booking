<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // ここにスケジュール設定
        $schedule->command('reminders:send')
        ->dailyAt('09:00') // 毎朝9時に実行
        ->timezone('Asia/Tokyo'); // 日本時間でスケジュール
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}