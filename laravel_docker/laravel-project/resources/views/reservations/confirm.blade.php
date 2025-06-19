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
    const form = document.getElementById('reservationForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(error => {
            alert(error.error || '予約処理中にエラーが発生しました');
        });
    });
});
</script>
</x-app-layout>