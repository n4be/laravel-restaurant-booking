<x-admin-app-layout>
    <x-slot name="pageTitle">
        <header class="d-flex border-bottom pb-3 align-items-center">
            <h2 class="m-0 fs-4">メニューを編集する</h2>
            <div class="ms-auto"><a href="{{ route('restaurant.show', $restaurant) }}"
                    style="text-decoration: none;">詳細に戻る</a></div>
        </header>
    </x-slot>

    <div class="container">
        <form method="POST" action="{{ route('restaurant.menu.update', [$restaurant, $menu]) }}">
            @method('PATCH')
            @csrf
            <div>
                <div class="mt-4">
                    <label for="name">メニュー名</label>
                    <input id="name" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="name" value="{{ old('name', $menu->name) }}" required placeholder="メニュー名">

                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="description">説明</label>
                    <input id="description" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="description" value="{{ old('description', $menu->description) }}" required placeholder="説明">

                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="price">料金</label>
                    <input id="price" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="price" value="{{ old('price', $menu->price) }}" required placeholder="料金">
                </div>
                <div class="flex items-center justify-center my-4">
                    <button
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        type="submit"><span class="block group-active:[transform:translate3d(0,1px,0)]">
                            更新する
                        </span></button>
                </div>
            </div>
        </form>
    </div>

</x-admin-app-layout>