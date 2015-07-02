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
        Schema::create('homework', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('name',50);
            $table->string('type_id',10);
            $table->string('detail',100);
            $table->string('sub_folder',100);
            $table->timestamp('assign_date');
            $table->timestamp('due_date');
            $table->timestamp('accept_date');
            $table->string('created_by',100);
            $table->char('semester',1);
            $table->char('year',4);
            $table->timestamps();
        });

        Schema::create('homework_student', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('course_id',6);
            $table->char('section',3);
            $table->string('homework_name',50);
            $table->char('student_id',9);
            $table->integer('status');
            $table->timestamp('submitted_at');
            $table->char('semester',1);
            $table->char('year',4);
            $table->timestamps();
        });

        Schema::create('homework_types', function(Blueprint $table)
        {
            $table->string('id',10);
            $table->string('extension',100);
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
        Schema::drop('homework');
        Schema::drop('homework_student');
        Schema::drop('homework_types');
    }

}
