<?php

use Illuminate\Support\Facades\DB;
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
            $table->string("game");
            $table->integer("player_id")->unsigned()->default(0);
            $table->string("name");
            $table->double("score")->unsigned()->default(0);
            $table->bigInteger("time")->unsigned()->default(0);
            $table->double("spm")->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('bf_kit_stats_log', function (Blueprint $table) {
            $table->foreign("player_id")
                ->references('id')
                ->on('players')
                ->onDelete('cascade');

            DB::statement("
              ALTER TABLE bf_kit_stats_log 
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
        Schema::dropIfExists('bf_kit_stats_log');
    }
}
