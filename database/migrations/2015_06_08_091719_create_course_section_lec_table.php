<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSectionLecTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('course_section_lec', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('teacherId',20);
            $table->primary(['courseId','sectionId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_section_lec');
    }

}
