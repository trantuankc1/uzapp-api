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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('code', 32)->nullable();
            $table->string('name');
            $table->string('thumbnail')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('price_tax_in')->nullable();
            $table->bigInteger('inventory')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('display_order')->default(0);
            $table->double('tax')->nullable();
            $table->integer('quantity')->default(0);
            $table->tinyInteger('status');
            $table->bigInteger('created_by_id');
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
        Schema::dropIfExists('products');
    }
};
