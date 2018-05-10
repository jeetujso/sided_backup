<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->longText('name')->nullable();
            $table->longText('text')->nullable();
            $table->string('medium')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->datetime('publish_at');
            $table->datetime('expire_at');
			$table->string('status')->nullable();
            $table->integer('ads_id')->unsigned()->default('0');
            $table->integer('question_type')->unsigned()->default('0');
            $table->integer('answer_type')->unsigned()->default('0');
            $table->integer('allowed_other_answer')->unsigned()->default('0');
            $table->integer('instant_result')->unsigned()->default('0');
            $table->integer('has_multiple_ans')->unsigned()->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('debates', function ($table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debates', function ($table) {
            $table->dropForeign('debates_question_id_foreign');
        });
        Schema::drop('questions');
    }
}
