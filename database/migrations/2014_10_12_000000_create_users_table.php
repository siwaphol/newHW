<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('username',100)->unique();
			$table->char('role_id',4);
            $table->char('student_id',9);
            $table->string('prefix_th',30);
            $table->string('prefix_en',30);
            $table->string('firstname_th',100);
            $table->string('firstname_en',100);
            $table->string('lastname_th',100);
            $table->string('lastname_en',100);
            $table->string('email',100);
            $table->char('faculty_id',3);
			$table->timestamps();

            $table->primary('username');
		});

        /**
         * Role is keep as 4-digit binary
         *  0000
         *  0001 = student
         *  0010 = ta
         *  0100 = teacher
         *  1000 = admin
         *  0011 = ta, student
         * @return void
         */
        Schema::create('ref_roles', function(Blueprint $table)
        {
            $table->char('id',4);
            $table->string('detail');
            $table->timestamps();

            $table->primary('id');
        });

        Schema::create('faculties', function(Blueprint $table)
        {
            $table->char('id',3)->unique();
            $table->string('name_th');
            $table->string('name_en');
            $table->timestamps();

            $table->primary('id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
        Schema::drop('ref_roles');
        Schema::drop('faculties');
    }

}
