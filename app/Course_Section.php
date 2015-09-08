<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Course_Section extends Model {

    protected $table = 'course_section';

    protected $appends = ['course_name','enroll_count'];
    protected $fillable = ['id','course_id','section', 'teacher_id', 'semester', 'year'];

    /**
     * Accessor Function
     */
    public function getCourseNameAttribute()
    {
        $local_course_name = DB::select('SELECT name FROM courses where id=? ', array( $this->attributes['course_id'] ));
        return $local_course_name[0]->name;
    }
    public function getEnrollCountAttribute()
    {
        $count = DB::select('SELECT COUNT(*) AS enroll_count FROM course_student WHERE course_id=? AND section=? AND semester=? AND year=? AND TRIM(status)="" ',
            array( $this->attributes['course_id'],$this->attributes['section'], $this->attributes['semester'], $this->attributes['year']));
        return $count[0]->enroll_count;
    }

    /**
     * @param $query
     * @return mixed
     *
     * @Sample usage $courses = Course_Section::semesterAndYear(1,2557)->orderBy('created_at')->get();
     * orderBy('created_at') is optional
     */
    public function scopeSemesterAndYear($query,$semester,$year)
    {
        return $query->where('semester','=',$semester)->where('year','=',$year);
    }

    public function scopeTeaching($query,$t_id,$semester,$year)
    {
        return $query->where('semester','=',$semester)->where('year','=',$year)->where('teacher_id','=',$t_id);
    }
}
