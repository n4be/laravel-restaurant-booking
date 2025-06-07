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
            if (!Schema::hasColumn('restaurant', 'user_id')) {
            $table->bigInteger('user_id')->unsigned();
            $table
            ->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant', function (Blueprint $table) {
            // $table->dropForeign('restaurant_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
