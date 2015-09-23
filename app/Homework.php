<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Homework extends Model {

    protected $table = 'homework';

    protected $appends = ['extension'];
    protected $fillable = ['course_id', 'section', 'name', 'type_id'
        ,'detail', 'assign_date', 'due_date'
        ,'accept_date','created_by','semester','year'];

    /**
     * Accessor Function
     */
    public function getExtensionAttribute()
    {
        $aType = DB::select('SELECT extension FROM homework_types where id=? ', array( $this->attributes['type_id'] ));
        return $aType[0]->extension;
    }

    public function getSubmitterAndSendStatus(){
        return $this->belongsToMany('App\User', 'course_student', 'course_id', 'student_id')->withTimestamps();
    }

}
