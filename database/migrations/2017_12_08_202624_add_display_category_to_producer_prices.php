<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayCategoryToProducerPrices extends Migration
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
            $table->integer('display_category_id')->unsigned()->nullable()->after('offer_id');
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
            $table->dropColumn('display_category_id');
        });
    }
}
