<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveflagAndOrderdeadlineToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            //
            $table->dateTime('order_deadline')->after('pickup_date');
            $table->tinyInteger('active_flag')->after('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            //
            $table->dropColumn('order_deadline');
            $table->dropColumn('active_flag');
        });
    }
}
