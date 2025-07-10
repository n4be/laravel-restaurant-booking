<x-admin-app-layout>
    <x-slot name="pageTitle">
        <header class="d-flex border-bottom pb-3 align-items-center">
            <h2 class="m-0 fs-4">予約状況一覧</h2>
        </header>
    </x-slot>

    <div class="container">

    <table class="table table-boardered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">開始時間</th>
      <th scope="col">終了時間</th>
      <th scope="col">レストラン名</th>
    </tr>
  </thead>
  <tbody>
    @forelse($reservations as $reservation)
    <tr>
      <th scope="row">1</th>
      <td>{{ $reservation->start_time->format('Y-m-d H:i') }}</td>
      <td>{{ $reservation->end_time->format('Y-m-d H:i') }}</td>
      <td>{{ $restaurant->name }}</td>
    </tr>
    @empty
    <p>予約がありません</p>
    @endforelse
  </tbody>
</table>

    </div>

</x-admin-app-layout>