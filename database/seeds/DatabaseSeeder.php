<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('UsersTableSeeder');
        $this->call('CoursesTableSeeder');
        $this->call('HomeworkTableSeeder');

    }

}

class UsersTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();
        DB::table('ref_roles')->delete();
        DB::table('faculties')->delete();

        DB::table('users')->insert(['username' => 'siwaphol_boonpan',
            'role_id' => '0100',
            'student_id' => '540510828',
            'prefix_th' => 'นาย',
            'prefix_en' => 'Mister',
            'firstname_th' => 'ศิวพล',
            'firstname_en' => 'Siwaphol',
            'lastname_th' => 'บุญปั๋น',
            'lastname_en' => 'Boonpan',
            'email' => 'siwaphol_boonpan@gmail.com',
            'faculty_id' => '05',
            'created_at' => '2015-06-22 00:00:00',
            'updated_at' => '2015-06-22 00:00:00']);

        DB::table('ref_roles')->insert(
            [            'id' => '0000',
                'detail' => 'no role',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('ref_roles')->insert(
            [            'id' => '0001',
                'detail' => 'student',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('ref_roles')->insert(
            [            'id' => '0010',
                'detail' => 'ta',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('ref_roles')->insert(
            [            'id' => '0100',
                'detail' => 'student',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('ref_roles')->insert(
            [            'id' => '1000',
                'detail' => 'admin',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('ref_roles')->insert(
            [            'id' => '0011',
                'detail' => 'student,ta',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);

        DB::table('faculties')->insert([
            'id' => '05',
            'name_th' => 'คณะวิทยาศาสตร์',
            'name_en' => 'Faculty of Science',
            'created_at' => '2015-06-22 00:00:00',
            'updated_at' => '2015-06-22 00:00:00']);

    }
}

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->delete();
        DB::table('course_section')->delete();
        DB::table('course_student')->delete();
        DB::table('course_ta')->delete();

        DB::table('courses')->insert([
            'id' => '204111',
            'name' => 'C programming',
            'detail' => '...',
            'created_at' => '2015-06-22 00:00:00',
            'updated_at' => '2015-06-22 00:00:00']);
        DB::table('courses')->insert([
               'id' => '204211',
                'name' => 'OOP programming',
                'detail' => '...',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('course_section')->insert([
                'course_id' => '204111',
                'section' => '001',
                'teacher_username' => 'siwaphol_boonpan',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('course_section')->insert([
               'course_id' => '204211',
                'section' => '001',
                'teacher_username' => 'siwaphol_boonpan',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('course_student')->insert([
                'course_id' => '204111',
                'section' => '001',
                'student_id' => '540510828',
                'status' => ' ',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('course_ta')->insert([
            'course_id' => '204111',
            'section' => '001',
            'ta_username' => 'siwaphol_boonpan',
            'created_at' => '2015-06-22 00:00:00',
            'updated_at' => '2015-06-22 00:00:00']);
    }
}

class HomeworkTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('homework')->delete();
        DB::table('homework_student')->delete();
        DB::table('homework_types')->delete();

        DB::table('homework')->insert([
                'course_id' => '204111',
                'section' => '001',
                'name' => 'lab01_[0-9]{9}',
                'type_id' => 'word',
                'detail' => 'Homework description goes here.',
                'sub_folder' => './lab01/',
                'assign_date' => '2015-06-26 00:00:00',
                'due_date' => '2015-06-30 00:00:00',
                'accept_date' => '2015-07-01 00:00:00',
                'created_by' => 'siwaphol_boonpan',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);

        DB::table('homework_student')->insert([
                'course_id' => '204111',
                'section' => '001',
                'homework_name' => 'lab01_540510828.doc',
                'student_id' => '540510828',
                'status' => '1',
                'submitted_at' => '2015-06-26 00:00:00',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);

        DB::table('homework_types')->insert(
            ['id' => 'word',
            'extension' => 'doc,docx',
            'created_at' => '2015-06-22 00:00:00',
            'updated_at' => '2015-06-22 00:00:00']);
        DB::table('homework_types')->insert(['id' => 'excel',
                'extension' => 'xls,xlsx',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
        DB::table('homework_types')->insert(['id' => 'c',
                'extension' => 'c,cpp',
                'created_at' => '2015-06-22 00:00:00',
                'updated_at' => '2015-06-22 00:00:00']);
    }
}



