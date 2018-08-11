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
            $table->bigIncrements('id');
            $table->string('email',  200)->unique();
            $table->string('username', 100)->unique();
            $table->string('password', 100);
            $table->string('phone', 25)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('avatar', 50)->nullable();
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
        Schema::dropIfExists('users');
    }
}
