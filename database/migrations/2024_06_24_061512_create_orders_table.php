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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('country');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('mobile');
            $table->text('order_notes')->nullable();
            $table->decimal('subtotal', 8, 2);
            $table->decimal('shipping', 8, 2)->default(20);
            $table->decimal('total', 8, 2);
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
