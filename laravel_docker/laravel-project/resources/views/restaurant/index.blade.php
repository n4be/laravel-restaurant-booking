<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('レストラン一覧') }}
    </h2>
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







</x-app-layout>