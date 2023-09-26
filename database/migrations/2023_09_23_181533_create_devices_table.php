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
            $table->unsignedInteger('hours_lastServ')->default(0);
            $table->unsignedInteger('actual_hours')->default(0);
            $table->date('update_actualHours')->nullable();
            $table->date('last_visit')->nullable();
            $table->integer('service_id')->default(1);
            $table->integer('prox_service')->default(1);
            $table->boolean('active')->default(1);
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
