<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesToProducerPricesTable extends Migration
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
            $table->text('notes')->nullable()->after('buy_price');
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
            $table->dropColumn('notes');
        });
    }
}
