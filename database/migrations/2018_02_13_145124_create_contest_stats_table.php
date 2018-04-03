<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contest_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->enum('event_type', ['click','impression'])->default('click');
            $table->integer('visitor_id')->unsigned()->nullable();
            $table->foreign('visitor_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('f_string')->nullable();
            
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
        Schema::dropIfExists('contest_stats');
    }
}
