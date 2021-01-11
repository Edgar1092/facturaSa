<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notification_id');
            $table->unsignedInteger('user_id');
            $table->foreign('notification_id')->references('id')->on('notifications');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('viewed')->default(false);
            $table->timestamp('viewed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_user');
    }
}
