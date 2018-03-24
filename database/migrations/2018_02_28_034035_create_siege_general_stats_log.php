<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiegeGeneralStatsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siege_general_stats_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string("event");
            $table->integer("player_id")->unsigned();
            $table->integer('score')->unsigned();
            $table->integer('roundsplayed')->unsigned();
            $table->integer('reinforcements')->unsigned();
            $table->integer('barricades')->unsigned();
            $table->integer('kill_assists')->unsigned();
            $table->integer('gadgets')->unsigned();
            $table->integer('melee_kills')->unsigned();
            $table->integer('penetration_kills')->unsigned();
            $table->integer('revives')->unsigned();
            $table->integer('dbno')->unsigned();
            $table->integer('wins')->unsigned();
            $table->integer('kills')->unsigned();
            $table->timestamps();
        });

        Schema::table('siege_general_stats_log', function (Blueprint $table) {
            $table->foreign("player_id")
                ->references('id')
                ->on('players')
                ->onDelete('cascade');

            DB::statement("
              ALTER TABLE siege_general_stats_log 
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
        Schema::dropIfExists('siege_general_stats_log');
    }
}
