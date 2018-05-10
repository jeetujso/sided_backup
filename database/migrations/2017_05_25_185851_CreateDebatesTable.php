<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('status')->default('needs_opponent');
            $table->datetime('starts_at');
            $table->datetime('ends_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('debate_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('debate_id')->unsigned();
            $table->foreign('debate_id')->references('id')->on('debates')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('question_ID')->nullable();
            $table->integer('votes')->default('0');
            $table->enum('side', array('Agree', 'Disagree'))->default('Agree');
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
        Schema::drop('debate_user');
        Schema::drop('debates');
    }
}
