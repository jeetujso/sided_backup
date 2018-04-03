<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debate_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('image_url');
            $table->string('icon_url');
            $table->integer('sort')->nullable();
            $table->integer('ads_id')->nullable();
			$table->string('status')->nullable()->default('live');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('questions', function ($table) {
            $table->foreign('category_id')->references('id')->on('debate_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function ($table) {
            $table->dropForeign('questions_category_id_foreign');
        });
        Schema::drop('debate_category');
    }
}
