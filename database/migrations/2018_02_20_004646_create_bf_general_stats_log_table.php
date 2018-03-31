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
            $table->integer("player_id")->unsigned()->default(0);
            $table->double("accuracy")->unsigned()->default(0);
            $table->integer("headshots")->unsigned()->default(0);
            $table->integer("heals")->unsigned()->default(0);
            $table->integer("kill_assists")->unsigned()->default(0);
            $table->integer("kills")->unsigned()->default(0);
            $table->integer("deaths")->unsigned()->default(0);
            $table->integer("ptfo")->unsigned()->default(0);
            $table->integer("repairs")->unsigned()->default(0);
            $table->integer("resupplies")->unsigned()->default(0);
            $table->integer("rounds_played")->unsigned()->default(0);
            $table->integer("squad_score")->unsigned()->default(0);
            $table->integer("suppression_assists")->unsigned()->default(0);
            $table->integer("wins")->unsigned()->default(0);
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
