<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('project_logo')->nullable();
            $table->string('project_name');
            $table->string('client_name');
            $table->foreignId('project_manager');
            $table->date('start');
            $table->date('end');
            $table->text('description');
            $table->enum('project_status', ['Pending', 'In Progress', 'Completed', 'Abandoned']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_manager')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
