<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('projectId')->unsigned();
            $table->foreign('projectId')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->enum('status', ['todo', 'progress', 'done']);
            $table->timestamp('createdAt'); 
            $table->timestamp('updatedAt'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
