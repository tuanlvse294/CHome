<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopHightlightReach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dateTime('top_expire')->default('1970-01-01');
            $table->dateTime('highlight_expire')->default('1970-01-01');
            $table->bigInteger('ads_reach');
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
            $table->dropColumn('top_expire');
            $table->dropColumn('highlight_expire');
            $table->dropColumn('ads_reach');
        });
    }
}
