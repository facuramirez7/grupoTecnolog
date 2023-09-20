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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('province_id');
            $table->string('address', 150);
            $table->string('email');
            $table->string('photo', 400)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
