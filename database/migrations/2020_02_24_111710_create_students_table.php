<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('phone');
            $table->string('description');

            $table->string('alias')->unique();
            $table->string('name');
            $table->string('lastName'); 
            $table->string('email');
            $table->string('password');
            $table->string('studies');
            $table->integer('course');
            $table->double('puntuation');
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
        Schema::dropIfExists('students');
    }
}
