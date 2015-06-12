<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('student', function(Blueprint $table)
        {
            $table->char('id',9);
            $table->string('studentName',50);
            $table->char('studentPw',4);
            $table->string('email',50);
            $table->string('phone',10);
            $table->primary('id');
        });

        DB::table('student')->insert(
            array(
                'id' => '540510828',
                'studentName' => 'Siwaphol',
                'studentPw' => '1234',
                'email' => 'siwaphol_boonpan@gmail.com',
                'phone' => '0821231234'
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
        Schema::drop('student');
    }

}
