<x-app-layout>
  <div class="py-12">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
      <h2 class="text-xl font-semibold mb-4">予約確認</h2>
      <p>時間: {{ \Carbon\Carbon::parse($start)->format('m/d H:i') }} 〜 {{ \Carbon\Carbon::parse($end)->format('H:i') }}
      </p>

      <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST" class="mt-6">
        @csrf
        <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">
        <input type="hidden" name="start_time" value="{{ $start }}">
        <input type="hidden" name="end_time" value="{{ $end }}">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
          予約を確定する
        </button>
        <a href="{{ route('showReservation', $restaurantId) }}" class="ml-4 text-gray-600">
          キャンセル
        </a>
      </form>
    </div>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMが読み込まれました - デバッグメッセージ'); // 確認用
    
    const form = document.getElementById('reservationForm');
    
    if (!form) {
        console.error('フォーム要素が見つかりません');
        return;
    }
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('フォーム送信がキャプチャされました'); // 確認用
        
        // フォームデータの確認
        const formData = new FormData(form);
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }
        
        // 実際の送信処理（fetch API使用）
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            console.log('レスポンスステータス:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('サーバー応答:', data);
            // リダイレクトが必要な場合
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(error => console.error('エラー:', error));
    });
});
</script>
</x-app-layout>