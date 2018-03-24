<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBfFlagAndBombPtfoStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bf_general_stats_log', function (Blueprint $table) {
            $table->integer('flags_captured')->unsigned();
            $table->integer('flags_defended')->unsigned();
            $table->integer('bombs_placed')->unsigned();
            $table->integer('bombs_defused')->unsigned();
            $table->integer('orders_completed')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bf_general_stats_log', function (Blueprint $table) {
            $table->removeColumn('flags_captured');
            $table->removeColumn('flags_defended');
            $table->removeColumn('bombs_placed');
            $table->removeColumn('orders_completed');
        });
    }
}
