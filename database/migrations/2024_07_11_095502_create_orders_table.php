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
            $table->id('order_id');
            $table->string('order_number');
            $table->date('order_date');
            $table->decimal('total_price', 8, 2);
            $table->unsignedBigInteger('customer_id');
            $table->decimal('discount', 5, 2)->nullable();
            // $table->unsignedBigInteger('payment_id');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->softDeletes();
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
