<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Homework extends Model {

    protected $table = 'homework';

    //s is short for simple :P
    protected $appends = ['extension','s_due_date','s_accept_date','no_id_name'];
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

    public function getSDueDateAttribute()
    {
        $date = new Carbon($this->due_date);
        return $date->format('d M');
    }

    public function getSAcceptDateAttribute()
    {
        $date = new Carbon($this->accept_date);
        return $date->format('d M');
    }

    public function getNoIdNameAttribute()
    {
        $pattern = '/[_]?+\{id\}[_]?/';
        return preg_replace($pattern,'',$this->attributes['name']);
    }
    /**
     * Scope
     */
    public function scopeFromCourseAndSection($query,$course_no,$section,$semester,$year)
    {
        return $query->where('course_id', '=', $course_no)
            ->where('section','=',$section)
            ->where('semester','=',$semester)
            ->where('year','=',$year);
    }

    /**
     * Custom funciton
     */
    public function createFullFilename($student_id)
    {
        $fullname_arr = array();
        //Need some help here dont let it be static like this use config instead
        if($this->attributes['type_id']==='000' || $this->attributes['type_id']==='001'){
            array_push($fullname_arr,str_replace('{id}',$student_id,$this->attributes['name']));
        }else{
            $filename = str_replace('{id}',$student_id,$this->attributes['name']);
            $extension = explode(',',$this->extension);
            foreach($extension as $aExt){
                array_push($fullname_arr,$filename.$aExt);
            }
        }
        return $fullname_arr;
    }
}
