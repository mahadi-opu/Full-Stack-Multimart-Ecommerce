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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('category_id');
            $table->bigInteger('subcategory_id')->nullable();
            $table->string('image_path')->nullable();
            $table->string('code')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->bigInteger('brand_id')->nullable()->default(0);
            $table->bigInteger('supplier_id')->nullable();
            $table->decimal('current_purchase_cost', 11, 3);
            $table->decimal('current_sale_price', 11, 3)->nullable();
            $table->decimal('previous_purchase_cost', 11, 3)->nullable();
            $table->decimal('current_wholesale_price', 11, 3)->nullable();
            $table->decimal('wholesale_minimum_qty', 11, 3)->nullable()->default(1);
            $table->decimal('previous_wholesale_price', 11, 3)->nullable();
            $table->decimal('previous_sale_price', 11, 3)->nullable();
            $table->decimal('available_quantity', 11, 3)->default(0);
            $table->tinyInteger('discount_type')->default(0)->comment('fixed=0,percentage=1')->nullable();
            $table->decimal('discount',11,2)->default(0)->nullable();
            $table->string('unit_type')->comment('kg,gm,li')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_popular')->nullable()->comment('0=no,1=yes');
            $table->tinyInteger('is_trending')->nullable()->comment('0=no,1=yes');
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
        Schema::dropIfExists('products');
    }
};
