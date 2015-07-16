<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomework1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('homework1s', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id');$table->string('cours_id');$table->string('section');$table->string('name');$table->string('type_id');$table->string('detail');$table->string('sub_folder');$table->string('assign_date');$table->string('due_date');$table->string('accept_date');
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
        Schema::drop('homework1s');
    }
}