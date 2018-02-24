<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBfKitStatsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bf_kit_stats_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string("event");
            $table->enum("game", ["bf1, bf4"]);
            $table->integer("player_id")->unsigned();
            $table->string("name");
            $table->float("score");
            $table->bigInteger("time");
            $table->float("spm");
            $table->timestamps();
        });

        Schema::table('bf_kit_stats_log', function (Blueprint $table) {
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
        Schema::dropIfExists('bf_kit_stats_log');
    }
}
