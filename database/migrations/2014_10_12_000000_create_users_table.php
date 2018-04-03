<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password')->nullable();
            $table->string('handle')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_url')->default('user.svg');
            $table->string('background_img')->nullable();
            $table->enum('go_online', ['false', 'true'])->default('false');
            $table->enum('notification_settings', ['false', 'true'])->default('false');
            $table->string('rank')->default('starter');
            $table->integer('total_points')->default('0');
            $table->boolean('is_admin')->default('0');
            $table->string('gender')->nullable();
            $table->integer('ads_id')->nullable();
            $table->string('timezone')->nullable();
            $table->datetime('last_activity')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
