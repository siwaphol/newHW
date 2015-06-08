<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ta', function(Blueprint $table)
        {
            $table->string('taId',20);
            $table->string('taName',50);
            $table->char('taPw',4);
            $table->string('phone',10);
            $table->string('email',50);
            $table->primary('taId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ta');
    }

}
