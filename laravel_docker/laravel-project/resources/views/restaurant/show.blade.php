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
      <a href="{{ route('restaurant.edit', [$restaurant, $menu])}}">
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


  <section class="container">
    <div class="row my-5">
      <div class="col-sm-5 my-3">
            <img src="{{ asset('storage/' . ($restaurant->image ? $restaurant->image : 'restaurant_images/comingsoon.webp')) }}"
      alt="{{ $restaurant->name }}" class="img-thumbnail">
      </div>
      <div class="col-sm-7">
<table class="table table-bordered">
    <thead>
  </thead>
  <tbody>
    <tr>
      <th class="col-3 text-center">店舗名</th>
      <td class="col-9">{{ $restaurant->name }}</td>
    </tr>
    <tr>
      <th class="col-3 text-center">エリア</th>
      <td>-</td>
    </tr>
    <tr>
      <th class="col-3 text-center">営業時間</th>
      <td>-</td>
    </tr>
    <tr>
      <th class="col-3 text-center">説明</th>
      <td>{{ $restaurant->description }}</td>
    </tr>
  </tbody>
</table>
      </div>


    </div>
  </section>

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
        <td>
          <button type="button" class="btn btn-success">
            <a href="{{ route('restaurant.menu.edit', [$restaurant, $menu]) }}" class="text-light text-decoration-none">
              編集
            </a>
          </button>
        </td>
        <td>削除</td>
      </tr>
      @empty
      <p class="text-center my-3">メニューが登録されていません</p>
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