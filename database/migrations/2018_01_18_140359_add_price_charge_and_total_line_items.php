<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceChargeAndTotalLineItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('line_items', function (Blueprint $table) {
            //
            $table->decimal('price_charged', 8, 2)->nullable()->after('quantity');
            $table->decimal('line_total', 8, 2)->nullable()->after('itemdiscount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('line_items', function (Blueprint $table) {
            //
            $table->dropColumn('price_charged');
            $table->dropColumn('line_total');
        });
    }
}
