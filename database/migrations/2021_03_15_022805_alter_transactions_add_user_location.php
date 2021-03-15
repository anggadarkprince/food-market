<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionsAddUserLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('destination_address')->after('payment_url')->nullable();
            $table->decimal('destination_lng', 10, 8)->after('destination_address')->nullable();
            $table->decimal('destination_lat', 11, 8)->after('destination_lng')->nullable();
            $table->string('restaurant_address')->after('destination_lat')->nullable();
            $table->decimal('restaurant_lng', 10, 8)->after('restaurant_address')->nullable();
            $table->decimal('restaurant_lat', 11, 8)->after('restaurant_lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('destination_address');
            $table->dropColumn('destination_lng');
            $table->dropColumn('destination_lat');
            $table->dropColumn('restaurant_address');
            $table->dropColumn('restaurant_lng');
            $table->dropColumn('restaurant_lat');
        });
    }
}
