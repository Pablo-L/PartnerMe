<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('alias')->unique();
            $table->string('name');
            $table->string('lastName')->nullable(); 

            $table->string('phone')->nullable();
            $table->string('description')->nullable();
            $table->string('studies')->nullable();
            $table->integer('course')->nullable();
            $table->double('puntuation')->nullable();
            
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('users');
    }
}
