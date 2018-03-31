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
            $table->integer("player_id")->unsigned()->default(0);
            $table->integer('score')->unsigned()->default(0);
            $table->integer('rounds_played')->unsigned()->default(0);
            $table->integer('reinforcements')->unsigned()->default(0);
            $table->integer('barricades')->unsigned()->default(0);
            $table->integer('kill_assists')->unsigned()->default(0);
            $table->integer('gadgets')->unsigned()->default(0);
            $table->integer('melee_kills')->unsigned()->default(0);
            $table->integer('penetration_kills')->unsigned()->default(0);
            $table->integer('revives')->unsigned()->default(0);
            $table->integer('dbno')->unsigned()->default(0);
            $table->integer('wins')->unsigned()->default(0);
            $table->integer('kills')->unsigned()->default(0);
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
