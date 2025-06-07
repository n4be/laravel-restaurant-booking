<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('レストラン一覧') }}
    </h2>
  </x-slot>



  <style>
    ul.horizontal-list {
      overflow-x: auto;
      display: flex;
      gap: 40px;
      width: 75%;
      margin: 50px auto;
      padding: 40px 40px;
      box-shadow: 0px 0px 14px 0px #b89a64;
    }

    li.item {
      flex: 0 0 25%;
      background-color: #fff;
      padding: 10px;
      box-sizing: border-box;
      box-shadow: 3px 4px 7px 0px #000;
      border-radius: 5px;
    }

    li .name {
      font-size: clamp(1.3rem, 2.5vw, 1.4rem);
    }

    li .description {
      font-size: 0.9rem;
      min-height: 80px;
      color: #4d4d4d;
      overflow-wrap: break-word;
    }

    .shop-detail {
      padding: 15px 10px 0 15px;
    }

    .area {
      color: white;
      font-size: 0.8rem;
      font-weight: bold;
      background: linear-gradient(45deg, #0c22cc, #0c22ccc9, #0c22ccf7);
      padding: 5px 15px;
      border-radius: 10px;
      display: inline-block;
      margin-bottom: 5px;
    }

    .item {
      transition: 0.3s ease;
    }

    .reserve {
      background: #53c03c;
    color: white;
    font-size: 0.9rem;
    font-weight: bold;
    padding: 10px 20px;
    display: block;
    text-align: center;
    border-radius: 15px;
    margin: 10px 0;
    }

    .item:hover {
      transform: scale(1.05);
      box-shadow: 4px 4px 8px 3px #000000;
    }
  </style>

  <ul class="horizontal-list">
    @foreach ($restaurants as $restaurant)

    <li class="item">
      <a href="{{ route('restaurant.show', ['id'=>$restaurant->id]) }}">
      <img
        src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
        alt="{{ $restaurant->name }}" class="img-fluid"
        style="max-width: 100%; max-height: 150px; object-fit: contain; margin:0 auto;">
      <div class="shop-detail">
        <div class="area">大阪</div>
        <div class="name">{{ $restaurant->name }}</div>
        <div class="description">{{ $restaurant->description }}</div>
      </div>
      <a class="reserve" href="{{ route('showReservation', ['id'=>$restaurant->id]) }}">予約する</a>
      </a>
    </li>

  @endforeach
  </ul>







</x-app-layout>