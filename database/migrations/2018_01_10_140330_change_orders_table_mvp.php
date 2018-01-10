<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrdersTableMvp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->string('email')->after('offer_id');
            $table->string('name')->after('email');
            $table->string('phone')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned();
            $table->dropColumn('email');
            $table->dropColumn('name');
            $table->dropColumn('phone');
        });
    }
}
