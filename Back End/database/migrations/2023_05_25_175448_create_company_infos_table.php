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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('company_address')->nullable();
            $table->string('about_us')->nullable();
            $table->string('refund_policy')->nullable();
            $table->string('privacy_policy')->nullable();
            $table->string('shipping_policy')->nullable();
            $table->string('terms_condition')->nullable();
            $table->string('created_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted')->nullable();
            $table->string('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
};
