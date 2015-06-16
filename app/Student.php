<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'students';

    protected $fillable = ['id', 'studentName', 'studentPw', 'email','phone'];

    public $incrementing = false;

    /**
     * A student can have many homeworks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeworks()
    {
        return $this->hasMany('App\Homework');
    }

    public function courses(){
        return $this->belongsToMany('App\Course', 'course_student', 'student_id', 'course_id')->withTimestamps();
    }

}
