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
//        Schema::create('homework_sending', function(Blueprint $table)
//        {
////            $table->engine = 'MyISAM';
////            $table->char('studentId',9);
////            $table->char('courseId',6);
////            $table->increments('homeworkId');
////            $table->float('sendStatus');
////            $table->float('checkScore');
////            $table->float('score');
////            $table->string('userId', 20);
////            $table->string('adminId', 20);
////            $table->primary(['studentId', 'courseId', 'homeworkId']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('homework_sending');
    }

}
