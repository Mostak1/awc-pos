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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('off_orders');
            $table->string('cash');
            $table->string('e_cash');
            $table->string('methode');
            $table->string('tranjection_number');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
