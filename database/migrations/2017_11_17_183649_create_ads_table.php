<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('website_url');
            $table->string('image_url');
            $table->integer('advertisement_type')->nullable();
            $table->float('cpm', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->enum('attached_status', array('Open', 'Attached'))->default('Open');
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
        Schema::dropIfExists('ads');
    }
}
