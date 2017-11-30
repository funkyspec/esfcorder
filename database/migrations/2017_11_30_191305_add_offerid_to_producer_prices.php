<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferidToProducerPrices extends Migration
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
            $table->integer('offer_id')->unsigned()->nullable()->after('producer_id');
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
            $table->dropColumn('offer_id');
        });
    }
}
