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
            $table->string('course_name',50);
            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('course_lec', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->string('course_name',50);
            $table->timestamps();

            $table->primary('course_id');
        });

        Schema::create('course_overall', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->string('course_name',50);
            $table->timestamps();

            $table->primary('course_id');
        });

        Schema::create('course_section', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('teacher_id',20);
            $table->timestamps();

            $table->primary(['course_id','section','teacher_id']);
        });

        Schema::create('course_section_lec', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('teacher_id',20);
            $table->timestamps();

            $table->primary(['course_id','section']);
        });

        Schema::create('course_section_overall', function(Blueprint $table)
        {
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('teacher_id',20);
            $table->timestamps();

            $table->primary(['course_id','section','teacher_id']);
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
        Schema::drop('course_lec');
        Schema::drop('course_overall');
        Schema::drop('course_section');
        Schema::drop('course_section_lec');
        Schema::drop('course_section_overall');

    }

}
