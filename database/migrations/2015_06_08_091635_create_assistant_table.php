<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('assistant', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('taId',20);
            $table->primary(['courseId','sectionId','taId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assistant');
    }

}
