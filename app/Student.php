<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Student extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'students';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'id', 'name', 'email','phone'];

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

//    public function roles()
//    {
//        return $this->belongsToMany('App\Role', 'role_user', );
//    }

}
