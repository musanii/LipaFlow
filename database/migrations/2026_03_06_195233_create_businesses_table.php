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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->enum('type',[
                'bar',
                'restaurant',
                'liquor_store'
            ]);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('kra_pin')->nullable();
            $table->boolean('etims_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
