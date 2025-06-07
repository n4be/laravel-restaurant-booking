<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('レストラン詳細') }}
    </h2>
  </x-slot>

  <div class="w-1/3 mx-auto my-10">
    <img src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
      alt="{{ $restaurant->name }}" class="img-fluid"
      style="max-width: 100%; max-height: 400px; object-fit: contain; margin:0 auto;">
    <div class="my-8 text-4xl text-center">{{ $restaurant->name }}</div>
    <div>{{ $restaurant->description }}</div>
  </div>

  <div class="text-center mb-5">
    <a href="{{ route('restaurant.edit', ['id' => $restaurant->id]) }}">
      <button
        class="bg-gradient-to-br from-green-300 to-green-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">編集</button>
    </a>
  </div>

  <div class="text-center">
    <form action="{{ route('restaurant.destroy', ['id' => $restaurant->id]) }}" method="post">
      @csrf
      <button type="submit"
        class="bg-gradient-to-br from-red-300 to-red-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">削除</button>
    </form>
  </div>







</x-app-layout>