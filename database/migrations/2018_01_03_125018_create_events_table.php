<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('website_url');
            $table->string('image_url');
            $table->longText('description');
            $table->string('status')->nullable();
			$table->datetime('publish_at');
            $table->datetime('expire_at');
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
        Schema::dropIfExists('events');
    }
}
