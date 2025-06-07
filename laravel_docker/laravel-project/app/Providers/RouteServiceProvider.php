<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('admin') // 任意のプレフィックス
            ->name('admin.')
            ->group(base_path('routes/admin.php')); // 追加するルートファイル
    }
}
