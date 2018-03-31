<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamworkIndexesToBf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bf_general_stats_log', function (Blueprint $table) {
            $table->boolean('is_clan_member')->default(false);
            $table->integer('time_played')->unsigned()->default(0);
            $table->double('teamwork_index')->default(0);
            $table->double('activity_index')->default(0);
            $table->double('ptfo_index')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bf_general_stats_log', function (Blueprint $table) {
            $table->removeColumn('is_clan_member');
            $table->removeColumn('time_played');
            $table->removeColumn('teamwork_index');
            $table->removeColumn('activity_index');
            $table->removeColumn('ptfo_index');
        });
    }
}
