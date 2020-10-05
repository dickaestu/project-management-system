<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_tasks_id');
            $table->foreignId('users_id');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('board_tasks_id')->references('id')->on('board_tasks')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_tasks');
    }
}
