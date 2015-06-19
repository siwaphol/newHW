<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllUserRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Admin table.
         */
        Schema::create('admins', function(Blueprint $table)
        {
            $table->string('username',20)->unique();
            $table->string('name',50);
            $table->timestamps();

            $table->primary('username');
        });
        /**
         * Teacher table.
         */
        Schema::create('teachers', function(Blueprint $table)
        {
            $table->string('username',20)->unique();
            $table->string('name',50);
            $table->timestamps();

            $table->primary('username');
        });
        /**
         * Student table.
         */
        Schema::create('students', function(Blueprint $table)
        {
            $table->string('username',20)->unique();
            $table->char('id',9);
            $table->string('name',50);
            $table->string('email',50);
            $table->string('phone',10);
            $table->timestamps();

            $table->primary('username');
        });
//        /**
//         * Ta table.
//         */
//        Schema::create('tas', function(Blueprint $table)
//        {
//            $table->string('username',20)->unique();
//            $table->string('name',50);
//            $table->string('phone',10);
//            $table->string('email',50);
//            $table->timestamps();
//
//            $table->primary('username');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
        Schema::drop('teachers');
        Schema::drop('students');
//        Schema::drop('tas');
    }

}
