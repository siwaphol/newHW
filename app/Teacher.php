<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    protected $table = 'teachers';

    protected $fillable = ['id', 'teacherName', 'teacherPw'];

    public $incrementing = false;

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

}
