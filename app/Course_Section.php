<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_Section extends Model {

    protected $table = 'course_section';

    protected $fillable = ['id','course_id','section', 'teacher_id', 'semester', 'year'];


}
