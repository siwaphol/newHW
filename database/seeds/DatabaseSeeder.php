<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Teacher;
use App\Student;
use App\Homework;
use App\Course;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('AdminTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('HomeworkTableSeeder');
        $this->call('PivotTableSeeder');
        $this->call('RoleTableSeeder');
        $this->call('StudentTableSeeder');
        $this->call('TeacherTableSeeder');
        $this->call('UserTableSeeder');
    }

}

class AdminTableSeeder extends Seeder {
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->insert(['username' => 'siwaphol_boonpan','name' => 'Siwaphol Admin','created_at' => '2015-06-22 00:00:00', 'updated_at' => '2015-06-22 00:00:00']);
    }
}


class CourseTableSeeder extends Seeder {
    public function run()
    {
        DB::table('courses')->delete();

        DB::table('courses')->insert(['id' => '204111','name' => 'Fundamental to Com Sci.']);
        DB::table('courses')->insert(['id' => '204211','name' => 'CS coding']);
    }
}
class HomeworkTableSeeder extends Seeder {
    public function run()
    {
        DB::table('homework_assignment')->delete();

        DB::table('homework_assignment')->insert(['course_id' => '204211','name' => 'homework1','type' => 'word',
            'detail' => 'Please Set homework name like this homework1_yourid.doc or .docx',
            'sub_folder' => '.', 'due_date' => '2015-07-01 00:00:00', 'assign_date' => '2015-06-22 00:00:00']);
    }
}

class PivotTableSeeder extends Seeder {
    public function run()
    {
        DB::table('course_student')->delete();
        DB::table('course_ta')->delete();
        DB::table('course_teacher')->delete();
        DB::table('homework_student')->delete();
        DB::table('role_user')->delete();

        // data assign parts
        DB::table('course_student')->insert(['student_username' => 'siwaphol_boonpan','course_id' => '204112', 'course_section' => '001']);
        DB::table('course_student')->insert(['student_username' => 'siwaphol_boonpan','course_id' => '204211', 'course_section' => '001']);

        DB::table('course_ta')->insert(['student_username' => 'siwaphol_boonpan','course_id' => '204211', 'course_section' => '001']);

        DB::table('course_teacher')->insert(['teacher_username' => 'siwaphol_boonpan','course_id' => '204211', 'course_section' => '001']);

        DB::table('homework_student')->insert(['course_id' => '204111','course_section' => '001',
            'homework_filename' => 'homework1_540510828.doc', 'student_username' => 'siwaphol_boonpan',
            'homework_status' => '1' ,'submitted_at' => '2015-06-11 01:02:03']);

        DB::table('role_user')->insert(['username' => 'siwaphol_boonpan','role_id' => 'student']);
        DB::table('role_user')->insert(['username' => 'siwaphol_boonpan','role_id' => 'ta']);
        DB::table('role_user')->insert(['username' => 'siwaphol_boonpan','role_id' => 'teacher']);
        DB::table('role_user')->insert(['username' => 'siwaphol_boonpan','role_id' => 'admin']);
    }
}

class RoleTableSeeder extends Seeder {
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert(['id' => 'admin','role_detail' => 'Admin has the biggest role.']);
        DB::table('roles')->insert(['id' => 'student','role_detail' => 'Student can only send homework.']);
        DB::table('roles')->insert(['id' => 'ta','role_detail' => 'Ta can only download homework file as zip.']);
        DB::table('roles')->insert(['id' => 'teacher','role_detail' => 'Teacher can assign homework and set homework status']);
    }
}

class StudentTableSeeder extends Seeder {
    public function run()
    {
        DB::table('students')->delete();

        DB::table('students')->insert(['username' => 'siwaphol_boonpan','id' => '540510828','name' => 'Siwaphol Student', 'email' => 'siwaphol_boonpan@cmu.ac.th', 'phone' => '0821231234']);
    }
}

class TeacherTableSeeder extends Seeder {
    public function run()
    {
        DB::table('teachers')->delete();

        DB::table('teachers')->insert(['username' => 'siwaphol_boonpan','name' => 'Siwaphol Teacher']);
    }
}
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['name' => 'testadmin','email' => 'admin@test.com','password' => '$2y$10$vPFkRIrD3X0v.e0kzlMW2OUDOJi3Qro0IsNMYE.hLyx4J.suWVhkG','role' => 'admin']);
        User::create(['name' => 'teststudent','email' => 'student@test.com','password' => '$2y$10$vPFkRIrD3X0v.e0kzlMW2OUDOJi3Qro0IsNMYE.hLyx4J.suWVhkG','role' => 'student']);
        User::create(['name' => 'testteacher','email' => 'teacher@test.com','password' => '$2y$10$vPFkRIrD3X0v.e0kzlMW2OUDOJi3Qro0IsNMYE.hLyx4J.suWVhkG','role' => 'teacher']);
        User::create(['name' => 'testta','email' => 'ta@test.com','password' => '$2y$10$vPFkRIrD3X0v.e0kzlMW2OUDOJi3Qro0IsNMYE.hLyx4J.suWVhkG','role' => 'ta']);
    }

}



