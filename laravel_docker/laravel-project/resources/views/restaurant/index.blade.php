<x-auth-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('レストラン一覧') }}
    </h2>
  </x-slot>

  <x-slot name="pageTitle">
    <header class="d-flex border-bottom pb-3 align-items-center">
      <h2 class="m-0 fs-4">レストラン一覧</h2>
      <button type="button" class="btn btn-primary ms-auto">
        <a href="{{ route('restaurant.create') }}" class="text-light" style="text-decoration: none;">
          <i class="bi bi-plus-circle me-1"></i>
          追加
        </a>
      </button>
    </header>
  </x-slot>

  <ul class="horizontal-list">
    @foreach ($restaurants as $restaurant)
    <li class="item">
      <a href="{{ route('restaurant.show', $restaurant) }}">
      <img
        src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
        alt="{{ $restaurant->name }}" class="img-fluid"
        style="max-width: 100%; max-height: 150px; object-fit: contain; margin:0 auto;">
      <div class="shop-detail">
        <div class="area">大阪</div>
        <div class="name">{{ $restaurant->name }}</div>
        <div class="description">{{ $restaurant->description }}</div>
      </div>
      <a class="reserve" href="{{ route('showReservation', ['id' => $restaurant->id]) }}">予約する</a>
      </a>
    </li>
  @endforeach
  </ul>

</x-auth-layout>