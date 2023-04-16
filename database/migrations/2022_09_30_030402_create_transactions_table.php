<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('open_id');
            $table->string('liff_msg_access_token')->nullable();
            $table->string('liff_notification_token')->nullable();
            $table->string('payment_intent_id', 50)->nullable();
            $table->string('payment_client_secret', 100)->nullable();
            $table->bigInteger('coupon_id')->nullable();
            $table->string('trans_no', 64)->nullable();
            $table->string('trans_confirm_no', 10)->nullable();
            $table->bigInteger('trans_origin_amount')->nullable();
            $table->bigInteger('trans_use_coupon')->nullable();
            $table->bigInteger('total_coupon_money')->nullable();
            $table->string('fee_type', 64)->nullable();
            $table->bigInteger('excise_tax')->nullable();
            $table->string('pay_method', 10)->nullable();
            $table->string('receive_method', 10)->nullable();
            $table->string('trans_pay_amount', 64)->nullable();
            $table->date('take_date')->nullable();
            $table->string('city', 64)->nullable();
            $table->string('district', 64)->nullable();
            $table->string('town', 64)->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_phone', 64)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->tinyInteger('trans_status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
