<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_prepaid_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('customer_card_number')->unique();
            $table->dateTime('card_valid_date')->nullable();
            $table->integer('total_meal');
            $table->integer('consumrd_meal')->nullable();
            $table->bigInteger('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->dateTime('card_activation_date')->nullable();
            $table->set('card_status',['ACTIVE','SUSPEND','BLOCKED'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('customer_prepaid_cards');
    }
};
