<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('teacher', function(Blueprint $table)
        {
            $table->string('id',20);
            $table->string('teacherName',50);
            $table->string('teacherPw',4);
            $table->primary('id');
        });

        DB::table('teacher')->insert(
            array(
                'id' => 'testt',
                'teacherName' => 'Test Teacher',
                'teacherPw' => '1234'
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
        Schema::drop('teacher');
    }

}
