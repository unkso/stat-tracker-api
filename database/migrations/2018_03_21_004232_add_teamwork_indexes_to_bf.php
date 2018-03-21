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
            $table->integer('time_played')->unsigned();
            $table->integer('teamwork_index')->unsigned();
            $table->integer('ptfo_index')->unsigned();
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
            $table->removeColumn('ptfo_index');
        });
    }
}
