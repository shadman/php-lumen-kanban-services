<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('projectId')->unsigned();
            $table->foreign('projectId')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->bigInteger('userId')->unsigned();
            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->timestamp('createdAt'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
