<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBfGeneralStatsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bf_general_stats_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string("event");
            $table->string("game");
            $table->integer("player_id")->unsigned();
            $table->double("accuracy")->unsigned();
            $table->integer("headshots")->unsigned();
            $table->integer("heals")->unsigned();
            $table->integer("kill_assists")->unsigned();
            $table->integer("kills")->unsigned();
            $table->integer("deaths")->unsigned();
            $table->integer("ptfo")->unsigned();
            $table->integer("repairs")->unsigned();
            $table->integer("resupplies")->unsigned();
            $table->integer("rounds_played")->unsigned();
            $table->integer("squad_score")->unsigned();
            $table->integer("suppression_assists")->unsigned();
            $table->integer("wins")->unsigned();
            $table->timestamps();
        });

        Schema::table('bf_general_stats_log', function (Blueprint $table) {
            $table->foreign("player_id")
                ->references('id')
                ->on('players')
                ->onDelete('cascade');

            DB::statement("
              ALTER TABLE bf_general_stats_log 
              MODIFY COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
              MODIFY COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
            ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bf_general_stats_log');
    }
}
