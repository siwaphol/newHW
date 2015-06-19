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

		$this->call('UserTableSeeder');
        $this->call('TeacherTableSeeder');
        $this->call('StudentTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('HomeworkSendingTableSeeder');
        $this->call('CourseStudentTableSeeder');
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

class TeacherTableSeeder extends Seeder {
    public function run()
    {
        DB::table('teachers')->delete();

        Teacher::create(['username' => 'siwaphol_boonpan','name' => 'Siwaphol Teacher']);
    }
}

class StudentTableSeeder extends Seeder {
    public function run()
    {
        DB::table('students')->delete();

        Student::create(['username' => 'siwaphol_boonpan','id' => '540510828','name' => 'Siwaphol Student', 'email' => 'siwaphol_boonpan@cmu.ac.th', 'phone' => '0821231234']);
    }
}

class AdminTableSeeder extends Seeder {
    public function run()
    {
        DB::table('admins')->delete();

        Student::create(['username' => 'siwaphol_boonpan','name' => 'Siwaphol Admin']);
    }
}

class CourseTableSeeder extends Seeder {
    public function run()
    {
        DB::table('courses')->delete();

        Course::create(['id' => '204111','name' => 'Fundamental to Com Sci.']);
        Course::create(['id' => '204211','name' => 'CS coding']);
    }
}

class HomeworkSendingTableSeeder extends Seeder {
    public function run()
    {
        DB::table('homework_sending')->delete();

        Homework::create(['student_id' => '540510828','courseId' => '201112','homeworkFileName' => 'test1', 'sendStatus' => '1', 'submitted_at' => '2015-06-11 01:02:03']);
    }
}

class CourseStudentTableSeeder extends Seeder {
    public function run()
    {
        DB::table('course_student')->delete();

        DB::table('course_student')->insert(['student_id' => '540510828','course_id' => '204112']);
        DB::table('course_student')->insert(['student_id' => '540510828','course_id' => '204211']);
    }
}



