<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /**
         * pivot table contains role for users
         *
         */
        Schema::create('role_user', function(Blueprint $table)
        {
            $table->char('username',20);
            $table->string('role_id',7);
            $table->timestamps();
        });

        Schema::create('course_student', function(Blueprint $table){
            $table->char('student_username',20);
            $table->char('course_id',6);
            $table->char('course_section',3);
            $table->timestamps();
        });

        Schema::create('course_ta', function(Blueprint $table){
            $table->char('student_username',20);
            $table->char('course_id',6);
            $table->char('course_section',3);
            $table->timestamps();
        });

        Schema::create('course_teacher', function(Blueprint $table){
            $table->char('teacher_username',20);
            $table->char('course_id',6);
            $table->char('course_section',3);
            $table->timestamps();
        });

        Schema::create('homework_student', function(Blueprint $table){
            $table->char('course_id',6);
            $table->char('course_section',3);
            $table->string('homework_filename',50);
            $table->char('student_username',20);
            $table->char('homework_status',1);
            $table->timestamp('submitted_at');
            $table->timestamps();
        });
//        /**
//         * Assistant table.
//         */
//        Schema::create('assistants', function(Blueprint $table)
//        {
//            $table->char('course_id',6);
//            $table->char('section',3);
//            $table->string('student_username',20);
//            $table->timestamps();
//
//            $table->primary(['course_id','section','student_username']);
//        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('role_user');
        Schema::drop('course_student');
        Schema::drop('course_ta');
        Schema::drop('course_teacher');
        Schema::drop('homework_student');
//        Schema::drop('assistants');
    }

}
