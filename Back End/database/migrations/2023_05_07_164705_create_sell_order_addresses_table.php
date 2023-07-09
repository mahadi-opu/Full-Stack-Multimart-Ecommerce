<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_order_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('sell_id');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->bigInteger('shipping_division');
            $table->bigInteger('shipping_district');
            $table->string('shipping_city')->nullable();
            $table->string('shipping_country');
            $table->string('shipping_zip');
            $table->string('shipping_state')->nullable();

            $table->string('billing_first_name')->nullable();
            $table->bigInteger('billing_division')->nullable();
            $table->bigInteger('billing_district')->nullable();
            $table->string('billing_last_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_order_addresses');
    }
};
