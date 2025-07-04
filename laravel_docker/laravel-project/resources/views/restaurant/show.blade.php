<x-auth-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('レストラン詳細') }}
    </h2>
  </x-slot>

  <x-slot name="pageTitle">
    <header class="d-flex border-bottom pb-3 align-items-center">
      <h2 class="m-0 fs-4">レストラン詳細</h2>
      @auth('admin')
      <div class="form-button ms-auto">
      <a href="{{ route('restaurant.edit', $restaurant)}}">
        <button class="button-edit">編集</button>
      </a>

      <form action="{{ route('restaurant.destroy', $restaurant) }}" method="post" id="deleteForm">
        @csrf
        @method('DELETE')
        <button type="submit" class="button-delete">削除</button>
      </form>
      </div>
    @endauth
    </header>
  </x-slot>

  <div class="w-1/3 mx-auto my-10">
    <img src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
      alt="{{ $restaurant->name }}" class="img-fluid"
      style="max-width: 100%; max-height: 400px; object-fit: contain; margin:0 auto;">
    <div class="my-8 text-4xl text-center">{{ $restaurant->name }}</div>
    <div>{{ $restaurant->description }}</div>
  </div>



  <div class="container">
    <header class="d-flex border-bottom pb-3 align-items-center">
      <h2 class="m-0 fs-4">メニュー</h2>
      <button type="button" class="btn btn-primary ms-auto">
        <a href="{{ route('restaurant.menu.create', $restaurant) }}" class="text-light" style="text-decoration: none;">
          <i class="bi bi-plus-circle me-1"></i>
          追加
        </a>
      </button>
    </header>
    <table class="table table-striped table-bordered mt-4 text-center">
      <thead>
        <tr>
          <th scope="col">名前</th>
          <th scope="col">料金</th>
          <th scope="col">-</th>
          <th scope="col">-</th>
        </tr>
      </thead>
      <tbody>
        @forelse($restaurant->menus as $menu)
        <tr>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->price }}円</td>
        <td>編集</td>
        <td>削除</td>
      @empty
        メニューが登録されていません
      </tr>
      @endforelse
      </tbody>
    </table>
    <!-- <table>
      <tr>
        <th>メニュー名</th>
        <th>料金</th>
      </tr>
      @forelse($restaurant->menus as $menu)
      <tr>
      <td>{{ $menu->name }}</td>
      <td>{{ $menu->price }}円</td>
  @empty
        メニューが登録されていません
        </tr>
      @endforelse
    </table> -->
  </div>

  <script>
    'use strict'
    {
      const deleteform = document.querySelector('#deleteForm');
      console.log(deleteform);
      deleteform.addEventListener('submit', (e) => {
        e.preventDefault();
        if (confirm('Sure?') === false) {
          return;
        }
        deleteform.submit();
      });
    }
  </script>

</x-auth-layout>