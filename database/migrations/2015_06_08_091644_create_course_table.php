<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('courses', function(Blueprint $table)
        {
            $table->char('id',6);
            $table->string('courseName',50);
            $table->string('teacher_id',20);
            $table->timestamps();

            $table->primary('id');

//            $table->foreign('teacher_id')
//                ->references('id')->on('teachers')
//                ->onUpdate('cascade');
        });

        Schema::create('course_student', function(Blueprint $table){
            $table->char('student_id',9);
            $table->char('course_id',6);

//            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
//            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade');
//            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
//            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('course_lec', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->string('courseName',50);
            $table->timestamps();

            $table->primary('courseId');
        });

        Schema::create('course_overall', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->string('courseName',50);
            $table->timestamps();

            $table->primary('courseId');
        });

        Schema::create('course_section', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('teacherId',20);
            $table->timestamps();

            $table->primary(['courseId','sectionId','teacherId']);
        });

        Schema::create('course_section_lec', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('teacherId',20);
            $table->timestamps();

            $table->primary(['courseId','sectionId']);
        });

        Schema::create('course_section_overall', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('teacherId',20);
            $table->timestamps();

            $table->primary(['courseId','sectionId','teacherId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
        Schema::drop('course_student');
        Schema::drop('course_lec');
        Schema::drop('course_overall');
        Schema::drop('course_section');
        Schema::drop('course_section_lec');
        Schema::drop('course_section_overall');

    }

}
