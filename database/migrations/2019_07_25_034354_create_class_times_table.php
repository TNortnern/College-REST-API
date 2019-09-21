<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_times', function (Blueprint $table) {
            $table->bigIncrements('ClassTimeID')->unsigned();
            $table->bigInteger('CourseID')->unsigned();
            $table->foreign('CourseID')->references('CourseID')->on('courses')->onDelete('cascade');
            $table->string('DayofWeek');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('ClassTime');
            $table->string('SemesterTaught');
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
        Schema::dropIfExists('class_times');
    }
}
