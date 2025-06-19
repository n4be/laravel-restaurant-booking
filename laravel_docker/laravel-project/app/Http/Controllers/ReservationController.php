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
        $reservations = Reservation::where('restaurant_id', $restaurantId)
            ->where('status', 'reserved')
            ->get();
        
        $events = [];
        $interval = new \DateInterval('PT1H');
        $period = new \DatePeriod(
            new \DateTime($request->query('start', now()->format('Y-m-d').' 10:00:00')),
            $interval,
            new \DateTime($request->query('end', now()->addDays(7)->format('Y-m-d').' 23:00:00'))
        );
        
        $now = now();
        
        foreach ($period as $slotStart) {
            $slotEnd = (clone $slotStart)->add($interval);
            
            // 過去の時間帯は×表示
            if ($slotStart < $now) {
                $events[] = [
                    'title' => '×',
                    'start' => $slotStart->format('Y-m-d H:i:s'),
                    'end' => $slotEnd->format('Y-m-d H:i:s'),
                    'color' => '#ffebee',
                    'display' => 'background',
                    'extendedProps' => [
                        'url' => null
                    ]
                ];
                continue;
            }
            
            // 予約チェック（時間帯が完全に一致する場合のみチェック）
            $isReserved = $reservations->contains(function ($res) use ($slotStart, $slotEnd) {
                return $res->start_time->format('Y-m-d H:i') === $slotStart->format('Y-m-d H:i') 
                    && $res->end_time->format('Y-m-d H:i') === $slotEnd->format('Y-m-d H:i');
            });
        
            $events[] = [
                'title' => $isReserved ? '×' : '○',
                'start' => $slotStart->format('Y-m-d H:i:s'),
                'end' => $slotEnd->format('Y-m-d H:i:s'),
                'color' => $isReserved ? '#ffebee' : '#e8f5e9',
                'display' => 'background',
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
    
            // 日付形式を正規化
            $startTime = new \DateTime($validated['start_time']);
            $endTime = new \DateTime($validated['end_time']);
    
            // 重複チェック（同じ時間帯のみチェック）
            $existing = Reservation::where('restaurant_id', $validated['restaurant_id'])
                ->where('start_time', $startTime->format('Y-m-d H:i:s'))
                ->where('end_time', $endTime->format('Y-m-d H:i:s'))
                ->exists();
    
            if ($existing) {
                return response()->json(['error' => 'この時間帯は既に予約されています'], 422);
            }
    
            // 過去の予約を防ぐ
            if ($startTime < now()) {
                return response()->json(['error' => '過去の時間は予約できません'], 422);
            }
    
            Reservation::create([
                'user_id' => Auth::id(),
                'restaurant_id' => $validated['restaurant_id'],
                'start_time' => $startTime->format('Y-m-d H:i:s'),
                'end_time' => $endTime->format('Y-m-d H:i:s'),
                'status' => 'reserved',
            ]);
    
            Cache::forget('reservations_' . $validated['restaurant_id']);
    
            return response()->json([
                'success' => '予約が完了しました',
                'redirect' => route('showReservation', ['id' => $validated['restaurant_id']])
            ]);
    
        } catch (\Exception $e) {
            \Log::error('予約エラー: ' . $e->getMessage());
            return response()->json(['error' => '予約処理中にエラーが発生しました'], 500);
        }
    }
}

