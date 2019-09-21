<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('StudentID');
            $table->string('StudentFirstName');
            $table->string('StudentLastName');
            $table->string('StudentEmail')->nullable()->unique();
            $table->string('StudentPhoneNumber')->nullable()->unique()->default(0);
            $table->string('HomeState')->default('AZ');
            $table->date('BirthDate')->default('1993-05-05');
            $table->string('Gender')->default('N/A');
            $table->integer('TotalCreditHours')->default(3);
            $table->float('GPA')->default(2.5);
            $table->string('SemesterEnrolled')->default('Fall');
            $table->bigInteger('Program')->unsigned()->default(1);
            $table->foreign('Program')->references('ProgramID')->on('programs');
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
        Schema::dropIfExists('students');
    }
}
