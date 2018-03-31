<?php

use Illuminate\Support\Facades\DB;
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
            $table->integer("player_id")->unsigned()->default(0);
            $table->string("name")->default(0);
            $table->integer("kills")->unsigned()->default(0);
            $table->double("hk")->unsigned()->default(0);
            $table->integer("shots")->unsigned()->default(0);
            $table->integer("hits")->unsigned()->default(0);
            $table->double("accuracy")->unsigned()->default(0);
            $table->string("special_name_1");
            $table->double("special_value_1");
            $table->string("special_name_2");
            $table->double("special_value_2");
            $table->string("special_name_3");
            $table->double("special_value_3");
            $table->timestamps();
        });

        Schema::table('siege_operator_stats_log', function (Blueprint $table) {
            $table->foreign("player_id")
                ->references('id')
                ->on('players')
                ->onDelete('cascade');

            DB::statement("
              ALTER TABLE siege_operator_stats_log 
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
        Schema::dropIfExists('siege_operator_stats_log');
    }
}
