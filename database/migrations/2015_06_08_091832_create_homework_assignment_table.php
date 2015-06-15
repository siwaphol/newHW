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
            $table->timestamps();

            $table->primary(['courseId','homeworkFileName']);
        });

        Schema::create('homework_sending', function(Blueprint $table)
        {
            $table->char('student_id',9);
            $table->char('courseId',6);
            $table->string('homeworkFileName',50);
            $table->integer('sendStatus');
            $table->timestamp('submitted_at');
            $table->timestamps();

//            $table->foreign('student_id')
//                ->references('id')->on('students')
//                ->onUpdate('cascade');
//            $table->foreign('student_id')
//                ->references('id')->on('students')
//                ->onDelete('cascade');
        });

        Schema::create('homework_type', function(Blueprint $table)
        {
            $table->string('hwTypeName',10);
            $table->timestamps();

            $table->primary('hwTypeName');
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
        Schema::drop('homework_sending');
        Schema::drop('homework_type');
    }

}
