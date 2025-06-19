{{-- resources/views/emails/reservations/reminder.blade.php --}}
<x-mail::message>
# 予約リマインダー通知

{{ $user->name }}様、以下の予約をお知らせします。

**予約詳細**  
🏠 店舗名: {{ $restaurant->name }}  
📅 日時: {{ $reservation->start_time->format('Y年m月d日 H:i') }}  
🔖 ステータス: 予約確定  

<x-mail::button :url="url('/reservations/'.$reservation->id)">
予約詳細を確認
</x-mail::button>
</x-mail::message>