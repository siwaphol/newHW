<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseLecTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('course_lec', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->string('courseName',50);
            $table->primary('courseId');
        });
    }

    public function down()
    {
        Schema::drop('course_lec');
    }

}
