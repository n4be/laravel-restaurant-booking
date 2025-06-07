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
        Schema::table('restaurant', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
        });

        Schema::table('restaurant', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // 必要なら元の型に戻す：例
            $table->integer('user_id')->change();
        });
    }
};
