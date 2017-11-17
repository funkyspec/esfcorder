<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducerPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producer_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('producer_id')->unsigned();
            $table->integer('sell_unit_id')->unsigned();
            $table->decimal('mbr_price', 8, 2);
            $table->decimal('non_mbr_price', 8, 2)->nullable();
            $table->integer('buy_unit_id')->unsigned()->nullable();
            $table->decimal('buy_price', 8, 2)->nullable();
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
        Schema::dropIfExists('item_weekly_prices');
    }
}
