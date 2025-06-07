<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('restaurant', 'restaurants');
        
        // 外部キー制約がある場合、一旦削除して再作成
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')
                  ->references('id')
                  ->on('restaurants')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ロールバック用
        Schema::rename('restaurants', 'restaurant');
        
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')
                  ->references('id')
                  ->on('restaurant')
                  ->onDelete('cascade');
        });
    }
};
