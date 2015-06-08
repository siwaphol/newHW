<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworkAssignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//        Schema::create('homework_assignment', function(Blueprint $table)
//        {
////            $table->engine = 'MyISAM';
////            $table->char('courseId',6);
////            $table->integer('homeworkId', true);
////            $table->string('homeworkFileName',50);
////            $table->string('homeworkFileType',5);
////            $table->string('homeworkDetail',100);
////            $table->string('subFolder',20);
////            $table->date('dueDate');
////            $table->primary(['courseId','homeworkId']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('homework_assignment');
    }

}
