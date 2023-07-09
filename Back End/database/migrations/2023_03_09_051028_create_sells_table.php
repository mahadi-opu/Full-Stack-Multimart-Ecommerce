<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('invoice_id')->nullable();
            $table->tinyInteger('sell_type')->comment('pos_sell=1,ecommerce_sell=2');
            $table->tinyInteger('sell_by')->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->decimal('total_vat_amount',11,3)->default(0);
            $table->decimal('shipping_cost',11,3)->default(0);
            $table->decimal('total_discount',11,3)->default(0);
            $table->decimal('total_payable_amount',11,3);
            $table->decimal('total_paid',11,2);
            $table->decimal('total_due',11,2);
            $table->tinyInteger('payment_type')->comment('0=>cash_on_hand,1=>online_pay')->nullable()->default(0);
            $table->tinyInteger('order_status')->comment('0=pending,1=processing,2=on_the_way 3=cancel_request,4=cancel_accepted,5=cancel_order_process_completed,6=order completed')->nullable();
            $table->timestamp('date');
            $table->tinyInteger('status')->comment('0=uncompleted,1=completed')->default(0);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->tinyInteger('deleted')->default(0)->comment('0=active,1=deleted');
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->unsignedInteger('deleted_by')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
};
