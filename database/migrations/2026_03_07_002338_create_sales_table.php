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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId( 'user_id')->constrained()->cascadeOnDelete();

            $table->string('table_number')->nullable();

            $table->decimal('total_amount',10,2);

            $table->enum('payment_method',[
                'cash',
                'mpesa',
                'card',
                'mixed'
            ])->nullable();

            $table->enum('status',[
                'open',
                'paid',
                'cancelled'
            ])->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
