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
        Schema::create('homework_assignment', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->string('homeworkFileName',50);
            $table->string('homeworkFileType',5);
            $table->string('homeworkDetail',100);
            $table->string('subFolder',20);
            $table->date('dueDate');
            $table->date('assignDate');
            $table->primary(['courseId','homeworkFileName']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('homework_assignment');
    }

}
