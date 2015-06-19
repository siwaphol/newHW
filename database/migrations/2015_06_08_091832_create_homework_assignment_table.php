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
            $table->char('course_id',6);
            $table->string('name',50);
            $table->string('type',10);
            $table->string('detail',100);
            $table->string('sub_folder',20);
            $table->date('due_date');
            $table->date('assign_date');
            $table->timestamps();

            $table->primary(['course_id','name']);
        });

        Schema::create('homework_sending', function(Blueprint $table)
        {
            $table->char('student_id',9);
            $table->char('course_id',6);
            $table->string('name',50);
            $table->integer('sendStatus');
            $table->timestamp('submitted_at');
            $table->timestamps();
            
        });

        Schema::create('homework_type', function(Blueprint $table)
        {
            $table->string('hwTypeName',10);
            $table->timestamps();

            $table->primary('hwTypeName');
        });

        Schema::create('file_type', function(Blueprint $table)
        {
            $table->string('id',10);
            $table->string('type_list',100);
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
        Schema::drop('homework_assignment');
        Schema::drop('homework_sending');
        Schema::drop('homework_type');
        Schema::drop('file_type');
    }

}
