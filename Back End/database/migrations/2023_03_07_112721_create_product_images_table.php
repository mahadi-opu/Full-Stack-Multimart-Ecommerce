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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('image');
            $table->tinyInteger('status')->default(1)->comment("active=1,inactive=0");
            $table->timestamp('created_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->tinyInteger('deleted')->default(0)->comment('not delete=0,deleted=1');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
};
