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
        Schema::create('money_transactions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('transaction_type')->comment('in, out');
            $table->bigInteger('purchase_id')->nullable();
            $table->bigInteger('sell_id')->nullable();
            $table->bigInteger('expense_id')->nullable();
            $table->decimal('total_amount')->default(0);
            $table->bigInteger('bank_id')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_invest')->default(0)->comment('1=yes,0=no');
            $table->date('date');
            $table->tinyInteger('status')->comment('0=inactive,1=active')->default(1);
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
        Schema::dropIfExists('money_transactions');
    }
};
