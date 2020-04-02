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
            
            $table->unsignedBigInteger('student_id_creator')->nullable();
            $table->unsignedBigInteger('student_id_receiver')->nullable();
//
            $table->foreign('student_id_creator')->references('id')->on('students')->onDelete('set null');
            $table->foreign('student_id_receiver')->references('id')->on('students')->onDelete('set null');
            
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
