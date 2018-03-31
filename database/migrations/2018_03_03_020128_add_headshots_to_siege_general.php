<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeadshotsToSiegeGeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siege_general_stats_log', function (Blueprint $table) {
            $table->integer("headshots")->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siege_general_stats_log', function (Blueprint $table) {
            $table->removeColumn("headshots");
        });
    }
}
