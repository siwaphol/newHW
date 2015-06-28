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
            $table->string('name',50);
            $table->string('detail',255);
            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('course_section', function(Blueprint $table)
        {
            $table->char('course_id',6)->unique();
            $table->char('section',3);
            $table->string('teacher_username',100);
            $table->timestamps();
        });

        Schema::create('course_student', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->char('section',3);
            $table->char('student_id',9);
            $table->timestamps();
        });

        Schema::create('course_ta', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('ta_username',100);
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
        Schema::drop('courses');
        Schema::drop('course_teacher');
        Schema::drop('course_student');
        Schema::drop('course_ta');
    }

}
