<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fingerprint_id')->unsigned()->nullable();
            $table->enum('event_type', ['debate_view','profile_view','ads_view','debate_start','give_argument','debate_join','give_vote','invite','add_comment'])->default('profile_view');
            $table->string('event_id');
            $table->integer('visitor_id')->unsigned()->nullable();
            $table->integer('points')->unsigned()->nullable();
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
        //
        Schema::drop('user_points');
    }
}
