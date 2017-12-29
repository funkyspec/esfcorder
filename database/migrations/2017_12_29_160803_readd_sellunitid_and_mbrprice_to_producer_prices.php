<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReaddSellunitidAndMbrpriceToProducerPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producer_prices', function (Blueprint $table) {
            //
            $table->integer('sell_unit_id')->unsigned()->nullable()->after('display_category_id');
            $table->decimal('mbr_price', 8, 2)->nullable()->after('sell_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producer_prices', function (Blueprint $table) {
            //
            $table->dropColumn('mbr_price');
            $table->dropColumn('sell_unit_id');
        });
    }
}
