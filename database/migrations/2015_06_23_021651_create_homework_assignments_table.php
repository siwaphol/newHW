<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomework_assignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('homework_assignments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('courseId');$table->string('homeworkFileName');$table->string('homworkFileType');$table->string('homeworkDetail');$table->string('issubFolder');$table->string('subFolder');$table->date('dueDtae');$table->date('assignDate');$table->date('acceptDate');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('homework_assignments');
    }
}