<x-admin-app-layout>
    <x-slot name="pageTitle">
        <header class="d-flex border-bottom pb-3 align-items-center">
            <h2 class="m-0 fs-4">レストランを登録する</h2>
        </header>
    </x-slot>


    <div class="container">
        <form method="POST" action="{{ route('restaurant.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="mt-4">
                    <label for="name">店舗名</label>
                    <input id="name" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="name" value="{{ old('name') }}" required placeholder="店舗名">
                </div>
                <div class="mt-4">
                    <label for="description">説明</label>
                    <input id="description" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="description" value="{{ old('description') }}" required placeholder="説明">
                </div>
                <div class="mt-4">
                    <label for="image">店舗画像</label>
                    <input id="image" type="file"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="image">
                </div>
                <div class="flex items-center justify-center my-4">
                    <button
                        class="group flex h-10 items-center justify-center rounded-md border border-gray-600 bg-gradient-to-b from-gray-400 via-gray-500 to-gray-600 px-4 text-neutral-50 shadow-[inset_0_1px_0px_0px_#d1d5db] hover:bg-gradient-to-b hover:from-gray-600 hover:via-gray-600 hover:to-gray-600 active:[box-shadow:none]"
                        type="submit"><span class="block group-active:[transform:translate3d(0,1px,0)]">
                            登録する
                        </span></button>
                </div>
            </div>
        </form>
    </div>

</x-admin-app-layout>