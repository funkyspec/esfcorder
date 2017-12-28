<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebEmailToProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producers', function (Blueprint $table) {
            //
            $table->string('email')->nullable()->after('county');
            $table->string('website')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producers', function (Blueprint $table) {
            //
            $table->dropColumn('email');
            $table->dropColumn('website');
        });
    }
}
