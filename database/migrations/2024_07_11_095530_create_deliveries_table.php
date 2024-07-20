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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('delivery_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('delivery_name')->nullable();
            $table->text('delivery_address')->nullable();
            $table->date('delivery_date');
            $table->unsignedBigInteger('courier_id');

            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('courier_id')->references('courier_id')->on('couriers');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
