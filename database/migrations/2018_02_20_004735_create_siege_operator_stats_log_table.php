<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiegeOperatorStatsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siege_operator_stats_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string("event");
            $table->integer("player_id")->unsigned();
            $table->string("name");
            $table->integer("kills");
            $table->float("hk");
            $table->integer("shots");
            $table->integer("hits");
            $table->float("accuracy");
            $table->string("special_name_1");
            $table->float("special_value_1");
            $table->string("special_name_2");
            $table->float("special_value_2");
            $table->string("special_name_3");
            $table->float("special_value_3");
            $table->timestamps();
        });

        Schema::table('siege_operator_stats_log', function (Blueprint $table) {
            $table->foreign("player_id")
                ->references('id')
                ->on('players')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siege_operator_stats_log');
    }
}
