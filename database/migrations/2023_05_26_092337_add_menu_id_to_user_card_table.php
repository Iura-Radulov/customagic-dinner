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
        Schema::table('user_card', function (Blueprint $table) {
            $table->bigInteger('menu_id')->unsigned()->index()->nullable();
            $table->foreign('menu_id')
                ->references('id')
                ->on('menu_type')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_card', function (Blueprint $table) {

        });
    }
};
