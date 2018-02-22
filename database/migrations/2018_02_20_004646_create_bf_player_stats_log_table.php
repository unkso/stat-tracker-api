<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBfPlayerStatsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bf_player_stats_log', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("game", ["bf1, bf42"]);
            $table->integer("player_id")->unsigned();
            $table->integer("kills")->unsigned();
            $table->integer("deaths")->unsigned();
            $table->timestamps();
        });

        Schema::table('bf_player_stats_log', function (Blueprint $table) {
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
        Schema::dropIfExists('bf_player_stats_log');
    }
}
