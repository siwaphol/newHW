<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model {

    protected $table = 'homework';

    protected $fillable = ['course_id', 'section', 'name', 'type_id'
        ,'detail','sub_folder', 'assign_date', 'due_date'
        ,'accept_date','created_by','semester','year'];

    public function getSubmitterAndSendStatus(){
        return $this->belongsToMany('App\User', 'course_student', 'course_id', 'student_id')->withTimestamps();
    }

}
