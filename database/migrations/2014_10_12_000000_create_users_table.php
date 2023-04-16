<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('open_id', 64)->unique();
                $table->string('first_name', 64)->nullable();
                $table->string('first_kana_name', 64)->nullable();
                $table->string('last_name', 64)->nullable();
                $table->string('last_kana_name', 64)->nullable();
                $table->string('person_name', 128)->nullable();
                $table->string('zipcode', 10)->nullable();
                $table->string('state', 64)->nullable();
                $table->string('city', 64)->nullable();
                $table->string('town', 64)->nullable();
                $table->string('address', 64)->nullable();
                $table->string('phone', 64)->nullable();
                $table->string('email')->unique()->nullable();
                $table->string('password')->nullable();
                $table->date('birthday')->nullable();
                $table->tinyInteger('gender')->nullable();
                $table->string('hobby')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamp('email_verified_at')->nullable();
                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
