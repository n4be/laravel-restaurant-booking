<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-reservation-reminders';
    protected $signature = 'reminders:send';
    protected $description = 'Send reservation reminder emails';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
// app/Console/Commands/SendReservationReminders.php


public function handle()
{
    $tomorrow = now()->addDay()->format('Y-m-d');
    
    $reservations = Reservation::whereDate('start_time', $tomorrow)
        ->with(['user', 'restaurant'])
        ->where('status', 'reserved')
        ->get();

    foreach ($reservations as $reservation) {
        Mail::to($reservation->user->email)
            ->send(new ReservationReminder($reservation));
        
        Log::info("予約リマインダー送信済み", [
            'reservation_id' => $reservation->id,
            'user_email' => $reservation->user->email
        ]);
    }
}
}
