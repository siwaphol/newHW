<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('admin', function(Blueprint $table)
        {
            $table->string('adminId',20)->unique();
            $table->primary('adminId');
            $table->string('adminName',50);
            $table->char('adminPw',4);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('admin');
	}

}
