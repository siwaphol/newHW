<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('message', function(Blueprint $table)
        {
            $table->string('courseid',10);
            $table->string('sectionid',3);
            $table->string('teacherid',10);
            $table->dateTime('date');
            $table->string('detail',30);
            $table->string('state',10);
            $table->timestamps();

            $table->primary(['courseid', 'sectionid', 'teacherid', 'date', 'detail', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message');
    }

}
