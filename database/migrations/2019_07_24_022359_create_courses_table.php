<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('CourseID')->unsigned();
            $table->bigInteger('InstructorID')->unsigned()->nullable();
            $table->bigInteger('Program')->unsigned();
            $table->foreign('InstructorID')->references('InstructorID')->on('instructors');
            $table->foreign('Program')->references('ProgramID')->on('programs');
            $table->string('CourseName');
            $table->string('ProgramCode', 3);
            $table->string('CourseNumber', 3);
            $table->string('Section');
            $table->text('Description');
            $table->smallInteger('CreditHours');
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
        Schema::dropIfExists('courses');
    }
}
