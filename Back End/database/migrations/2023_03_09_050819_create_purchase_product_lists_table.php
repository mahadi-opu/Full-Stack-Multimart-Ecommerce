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
        Schema::create('purchase_product_lists', function (Blueprint $table) {
            $table->id();
            $table->string('total_cost');
            $table->decimal('total_vat',11,3)->nullable();
            $table->decimal('total_discount',11,3)->nullable();
            $table->string('purchase_code')->nullable();
            $table->decimal('total_payable_amount',11,3);
            $table->decimal('total_paid',11,3);
            $table->decimal('total_due',11,3);
            $table->bigInteger('supplier_id');
            $table->timestamp('date');
            $table->tinyInteger('status')->default(1)->comment('0=inactive,1=active');
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
        Schema::dropIfExists('purchase_product_lists');
    }
};
