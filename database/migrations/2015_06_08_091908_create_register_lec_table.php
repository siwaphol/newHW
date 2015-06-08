<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterLecTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('register_lec', function(Blueprint $table)
        {
            $table->char('studentId',9);
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->primary(['studentId','courseId','sectionId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('register_lec');
    }

}
