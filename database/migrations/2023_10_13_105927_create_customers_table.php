<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('mobile')->unique();
            $table->string('address')->nullable();
            $table->string('card_number')->unique()->nullable();
            $table->dateTime('valid_date')->nullable();
            $table->dateTime('active_date')->nullable();
            $table->integer('total_meal');
            $table->integer('consumed_meal')->nullable();
            $table->bigInteger('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->set('card_status',['ACTIVE','SUSPEND','BLOCKED'])->nullable();
            $table->bigInteger('auth_id')->unsigned();
            $table->foreign('auth_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
