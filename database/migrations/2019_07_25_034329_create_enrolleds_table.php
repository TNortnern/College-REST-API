<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolleds', function (Blueprint $table) {
            $table->bigIncrements('EnrolledID')->unsigned();
            $table->bigInteger('InstructorID')->unsigned()->nullable();
            $table->bigInteger('StudentID')->unsigned()->nullable();
            $table->bigInteger('CourseID')->unsigned()->nullable();
            $table->foreign('CourseID')->references('CourseID')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('StudentID')->references('StudentID')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('InstructorID')->references('InstructorID')->on('instructors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolleds');
    }
}
