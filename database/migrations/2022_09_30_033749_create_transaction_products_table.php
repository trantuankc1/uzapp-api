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
        Schema::create('transaction_products', function (Blueprint $table) {
            $table->id();
            $table->string('open_id');
            $table->string('trans_no')->nullable();
            $table->bigInteger('product_id');
            $table->string('product_name');
            $table->integer('product_quantity');
            $table->bigInteger('product_origin_amount');
            $table->bigInteger('product_discount_amount')->nullable();
            $table->string('fee_type', 64)->nullable();
            $table->bigInteger('product_pay_amount');
            $table->tinyInteger('export_status');
            $table->timestamps();
            $table->timestamp('last_used_time')->nullable();
            $table->tinyInteger('used_counts')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_products');
    }
};
