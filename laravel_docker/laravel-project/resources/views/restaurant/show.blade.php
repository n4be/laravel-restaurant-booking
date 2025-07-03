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
<!-- 
  @auth
    <div class="form-button">
    <a href="{{ route('restaurant.edit', $restaurant)}}">
      <button class="button-edit">編集</button>
    </a>

    <form action="{{ route('restaurant.destroy', $restaurant) }}" method="post" id="deleteForm">
      @csrf
      @method('DELETE')
      <button type="submit" class="button-delete">削除</button>
    </form>
    </div>
  @endauth -->

  <div class="menu-container">
    <h2>メニュー一覧</h2>
    <table>
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
    </table>
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

</x-app-layout>