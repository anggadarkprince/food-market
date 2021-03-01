<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
            $table->foreignId('user_id');
            $table->foreignId('food_id');
            $table->integer('quantity');
            $table->decimal('total');
            $table->string('status');
            $table->text('payment_url');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('food_id')->references('id')->on('foods')->cascadeOnUpdate()->cascadeOnDelete();
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
}
