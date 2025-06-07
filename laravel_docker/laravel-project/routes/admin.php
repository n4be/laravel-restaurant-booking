<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// 管理者ログイン画面
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::middleware('guest:admin')->group(function () {
//         Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//         Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//     });

//     Route::middleware('auth:admin')->group(function () {
//         Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('dashboard');
//     });
// });

