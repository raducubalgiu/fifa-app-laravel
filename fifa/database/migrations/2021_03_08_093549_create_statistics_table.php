<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('player_username');
            $table->string('player_name');
            $table->string('player_team');
            $table->integer('player_goals')->unsigned();
            $table->integer('player_goals_received')->unsigned();
            $table->integer('player_points')->unsigned();
            $table->integer('player_victory')->unsigned();
            $table->integer('player_draw')->unsigned();
            $table->integer('player_lose')->unsigned();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->foreignId('championship_id')->nullable();
            $table->string('match_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
