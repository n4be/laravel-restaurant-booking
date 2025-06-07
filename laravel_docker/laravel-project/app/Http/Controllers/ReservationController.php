<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // コントローラー上部に追加

class ReservationController extends Controller
{
    // カレンダーに渡すイベントデータ
    public function getEvents(Request $request)
    {
        $restaurantId = $request->query('restaurant_id');
        $reservations = Reservation::where('restaurant_id', $restaurantId)->get();
    
        $events = [];
        $interval = new \DateInterval('PT1H'); // 1時間間隔に変更
        $period = new \DatePeriod(
            new \DateTime(now()->format('Y-m-d').' 10:00:00'),
            $interval,
            new \DateTime(now()->addDays(7)->format('Y-m-d').' 23:00:00') // 1週間分表示
        );
    
        foreach ($period as $slotStart) {
            $slotEnd = (clone $slotStart)->add($interval);
            $isReserved = $reservations->contains(function ($res) use ($slotStart, $slotEnd) {
                return $res->start_time < $slotEnd && $res->end_time > $slotStart;
            });
    
            $events[] = [
                'title' => $isReserved ? '×' : '○',
                'start' => $slotStart->format('Y-m-d H:i:s'),
                'end' => $slotEnd->format('Y-m-d H:i:s'),
                'color' => $isReserved ? '#ffebee' : '#e8f5e9',
                'extendedProps' => [
                    'url' => !$isReserved ? route('reservations.confirm', [
                        'start' => $slotStart->format('Y-m-d H:i:s'),
                        'end' => $slotEnd->format('Y-m-d H:i:s'),
                        'restaurant_id' => $restaurantId
                    ]) : null
                ]
            ];
        }
    
        return response()->json($events);
    }

    public function showReservation($id) {
        // $id はレストランID
        return view('restaurant.reservation', ['restaurant_id' => $id]);
    }

    // 予約確認ページ（モーダルなら不要）
    public function confirm(Request $request)
    {
        $start = $request->query('start');
        $restaurantId = $request->query('restaurant_id');
        $end = (new \DateTime($start))->add(new \DateInterval('PT1H'))->format('Y-m-d H:i:s');
        
        return view('reservations.confirm', compact('start', 'end', 'restaurantId'));
    }

    // 予約保存
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'restaurant_id' => 'required|exists:restaurants,id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ]);
    
            // 重複チェック（排他ロックを追加）
            $existing = Reservation::where('restaurant_id', $validated['restaurant_id'])
                ->where(function($query) use ($validated) {
                    $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                          ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
                })->lockForUpdate()->exists();
    
            if ($existing) {
                return back()->withErrors(['この時間帯は既に予約されています']);
            }
    
            Reservation::create([
                'user_id' => Auth::id(),
                'restaurant_id' => $validated['restaurant_id'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'status' => 'reserved',
            ]);
    
            Cache::forget('reservations_' . $validated['restaurant_id']);
    
            return redirect()->route('showReservation', [
                'id' => $validated['restaurant_id']
            ])->with([
                'success' => '予約が完了しました',
                'refresh' => true
            ]);
    
        } catch (\Exception $e) {
            \Log::error('予約エラー: ' . $e->getMessage());
            return back()->withErrors(['予約処理中にエラーが発生しました']);
        }
    }
}

