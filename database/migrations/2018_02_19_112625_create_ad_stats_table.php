<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_id')->unsigned();
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            
            $table->integer('attached_question_id')->unsigned()->nullable();
            $table->foreign('attached_question_id')->references('id')->on('questions')->onDelete('cascade');
            
            $table->enum('event_type', ['click','impression'])->default('click');
            $table->integer('visitor_id')->unsigned()->nullable();
            $table->foreign('visitor_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('fingerprint_string')->unsigned()->nullable();



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
        Schema::dropIfExists('ad_stats');
    }
}
