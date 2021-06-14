<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('firstplayer_id');
            $table->string('firstplayer_username');
            $table->string('firstplayer_name');
            $table->string('firstplayer_team');
            $table->string('firstplayer_goals');
            $table->integer('secondplayer_id');
            $table->string('secondplayer_goals');
            $table->string('secondplayer_username');
            $table->string('secondplayer_name');
            $table->string('secondplayer_team');
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
        Schema::dropIfExists('games');
    }
}
