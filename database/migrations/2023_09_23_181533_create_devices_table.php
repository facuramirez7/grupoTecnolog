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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->unsignedBigInteger('deviceType_id');
            $table->string('model', 100);
            $table->string('serial_number', 50);
            $table->integer('hours_lastServ')->default(0);
            $table->integer('actual_hours')->default(0);
            $table->date('update_actualHours')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('visit_type')->nullable();
            $table->integer('prox_service')->nullable();
            $table->string('photo', 400)->nullable();
            $table->timestamps();

            $table->foreign('deviceType_id')->references('id')->on('device_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
