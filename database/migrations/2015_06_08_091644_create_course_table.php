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
        Schema::create('course', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->string('courseName',50);
            $table->string('teacher_id',20);
            $table->primary('courseId');

            $table->foreign('teacher_id')
                ->references('id')->on('teacher')
                ->onUpdate('cascade');
        });

        DB::table('course')->insert(
            array(
                'courseId' => '201112',
                'courseName' => 'CS course',
                'teacher_id' => 'testt'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course');
    }

}
