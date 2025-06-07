<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 一般ユーザー
            $table->foreignId('restaurant_id')->constrained('restaurant')->onDelete('cascade'); // レストラン
            $table->dateTime('start_time'); // 開始時間
            $table->dateTime('end_time');   // 終了時間
            $table->string('status')->default('reserved'); // 状態（例: reserved, canceled など）
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

