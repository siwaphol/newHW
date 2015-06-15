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
            $table->string('id',20)->unique();
            $table->primary('id');
            $table->string('adminName',50);
            $table->char('adminPw',4);
            $table->timestamps();
        });
        /**
         * Assistant table.
         */
        Schema::create('assistants', function(Blueprint $table)
        {
            $table->char('courseId',6);
            $table->char('sectionId',3);
            $table->string('taId',20);
            $table->timestamps();

            $table->primary(['courseId','sectionId','taId']);
        });
        /**
         * Teacher table.
         */
        Schema::create('teachers', function(Blueprint $table)
        {
            $table->string('id',20);
            $table->string('teacherName',50);
            $table->string('teacherPw',4);
            $table->timestamps();

            $table->primary('id');
        });
        /**
         * Student table.
         */
        Schema::create('students', function(Blueprint $table)
        {
            $table->char('id',9);
            $table->string('studentName',50);
            $table->char('studentPw',4);
            $table->string('email',50);
            $table->string('phone',10);
            $table->timestamps();

            $table->primary('id');
        });
        /**
         * Ta table.
         */
        Schema::create('tas', function(Blueprint $table)
        {
            $table->string('id',20);
            $table->string('taName',50);
            $table->char('taPw',4);
            $table->string('phone',10);
            $table->string('email',50);
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
        Schema::drop('admins');
        Schema::drop('assistants');
        Schema::drop('teachers');
        Schema::drop('students');
        Schema::drop('tas');
    }

}
