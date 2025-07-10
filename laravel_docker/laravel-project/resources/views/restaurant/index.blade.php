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

  <div class="container">
    <div class="row mt-5">
      @foreach($restaurants as $restaurant)
      <div class="col-md-6 col-xl-4 mb-3">
      <div class="card" style="width: 18em;">
        <img
        src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
        class="card-img-top" alt="{{ $restaurant->name }}">
        <div class="card-body">
        <a href="{{ route('restaurant.show', $restaurant) }}">
          <h5 class="card-title">{{ $restaurant->name }}</h5>
        </a>
        <p class="card-text">{{ $restaurant->description }}</p>
        </div>
      </div>
      </div>
    @endforeach
    </div>
  </div>




</x-auth-layout>