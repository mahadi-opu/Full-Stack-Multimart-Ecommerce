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
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type');
            $table->string('sell_id');
            $table->string('total_paid');
            $table->string('tnx_id');
            $table->string('card_brand')->nullable();
            $table->string('card_last_digit');
            $table->string('payment_inv_link')->nullable();
            $table->timestamp('created_at')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_infos');
    }
};
