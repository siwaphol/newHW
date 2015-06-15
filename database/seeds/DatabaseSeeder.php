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

        User::create(['name' => 'teststudent','email' => 'student@test.com','password' => '12345678','role' => 'student']);
    }

}

class TeacherTableSeeder extends Seeder {
    public function run()
    {
        DB::table('teachers')->delete();

        Teacher::create(['id' => 'testteacher','teacherName' => 'Test Teacher','teacherPw' => '1234']);
    }
}

class StudentTableSeeder extends Seeder {
    public function run()
    {
        DB::table('students')->delete();

        Student::create(['id' => '540510828','studentName' => 'Test Student','studentPw' => '1234', 'email' => 'siwaphol_boonpan@gmail.com', 'phone' => '0821231234']);
    }
}

class CourseTableSeeder extends Seeder {
    public function run()
    {
        DB::table('courses')->delete();

        Course::create(['id' => '204112','courseName' => 'CS course','teacher_id' => 'testteacher']);
        Course::create(['id' => '204211','courseName' => 'CS coding','teacher_id' => 'testteacher']);
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



