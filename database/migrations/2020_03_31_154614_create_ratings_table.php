<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //$table->unsignedBigInteger('student_id');
            //$table->foreign('student_id')->references('id')->on('students');
            
            $table->unsignedBigInteger('student_id_creator');
            $table->unsignedBigInteger('student_id_receiver');
//
            $table->foreign('student_id_creator')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('student_id_receiver')->references('id')->on('students')->onDelete('cascade');
            
            $table->double('points');
            $table->string('comment');
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
    }
}
