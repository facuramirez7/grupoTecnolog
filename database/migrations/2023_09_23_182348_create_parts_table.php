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
            $table->unsignedBigInteger('part_type_id');
            $table->unsignedInteger('buy_prize')->default(0);
            $table->unsignedInteger('sell_prize')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();

            $table->foreign('part_type_id')->references('id')->on('part_types');
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
