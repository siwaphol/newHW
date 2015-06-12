<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworkSendingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('homework_sending', function(Blueprint $table)
        {
            $table->char('student_id',9);
            $table->char('courseId',6);
            $table->string('homeworkFileName',50);
            $table->integer('sendStatus');
            $table->timestamp('submitted_at');
//            $table->float('checkScore');
//            $table->float('score');
//            $table->string('userId', 20);
//            $table->string('adminId', 20);
//            $table->primary(['studentId', 'courseId', 'homeworkFileName']);

            $table->foreign('student_id')
                  ->references('id')->on('student')
                  ->onUpdate('cascade');

        });

        DB::table('homework_sending')->insert(
            array(
                'student_id' => '540510828',
                'courseId' => '201112',
                'homeworkFileName' => 'test1',
                'sendStatus' => '1',
                'submitted_at' => '2015-06-11 01:02:03'
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
        Schema::drop('homework_sending');
    }

}
