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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 400)->nullable();
            $table->string('serial_number', 50)->unique();
            $table->string('description', 100);
            $table->integer('buy_prize')->default(0);
            $table->integer('sell_prize')->default(0);
            $table->unsignedInteger('stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
