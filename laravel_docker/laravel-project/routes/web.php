<?php

use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


// breezeデフォルト
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('default.login');



// 一般ユーザー用ダッシュボード
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('user.dashboard');

//     Route::get('/profile', action: [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// breezeデフォルトend

// 管理者と一般ユーザーで認証を分ける
Route::prefix('user')->name('user.')->group(function () {
    require __DIR__ . '/web_user.php';
});

Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/web_admin.php';
});

Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::get('/restaurant/show/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::delete('/restaurant/destroy/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');
Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::post('/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
Route::get('/restaurant/reservation/{id}', [ReservationController::class, 'showReservation'])->name('showReservation');
Route::get('/reservations/events', [ReservationController::class, 'getEvents']);
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store')->middleware('auth');;
Route::get('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');

//メニュー
Route::resource('restaurants.menus', MenuController::class)->only('store', 'destroy');

// require __DIR__.'/auth.php';
// require __DIR__.'/admin.php';
