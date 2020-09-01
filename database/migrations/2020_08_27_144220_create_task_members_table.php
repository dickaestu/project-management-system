<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_tasks_id');
            $table->foreignId('project_members_id');
            $table->timestamps();

            $table->foreign('board_tasks_id')->references('id')->on('board_tasks')->onUpdate('cascade');
            $table->foreign('project_members_id')->references('id')->on('project_members')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_members');
    }
}
