<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="  position: relative;
  box-sizing: border-box;
  padding-bottom: 120px;
  min-height: 100vh;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


</head>

<body>

    <header class="container text-center bg-primary p-4 d-flex align-items-center">
        <h1 class="text-light">Restaurant</h1>
        <div class="ms-auto">
            <nav class="d-flex align-items-center">
                <a href="{{ route('admin.profile.edit') }}" class="text-light me-3">
                    <i class="bi bi-person-circle text-light me-1"></i>
                    {{ Auth::guard('admin')->user()->name }}
                </a>
                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button class="btn btn-light">ログアウト</button>
                </form>
            </nav>
        </div>
    </header>

    <section class="container mt-5">
        <section class="row">
            <section class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('restaurant.index') }}" class="list-group-item list-group-item-action active"
                        aria-current="true">
                        レストラン一覧
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">メニュー管理</a>
                    <a href="{{ route('reservations.index') }}" class="list-group-item list-group-item-action">予約状況</a>
                    <a href="#" class="list-group-item list-group-item-action">管理者を登録する</a>
                </div>
            </section>
            <section class="col-md-9 mt-3">
                <main>
                    @isset($pageTitle)
                        {{ $pageTitle }}
                    @else

                    @endisset
                    <!-- <header class="d-flex border-bottom pb-3 align-items-center">
                        <h2 class="m-0 fs-4">レストラン一覧</h2>
                        <button type="button" class="btn btn-primary ms-auto">
                            <i class="bi bi-plus-circle me-1"></i>
                            追加
                        </button>
                    </header> -->

                    @if (session('success'))
                        <div class="alert alert-success text-center mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </section>
        </section>
    </section>


    <footer class="bg-secondary p-5 mt-5 text-center text-light" style="  position: absolute;
  bottom: 0;
  width: 100%;">
        (c) XXXXX.inc
    </footer>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>