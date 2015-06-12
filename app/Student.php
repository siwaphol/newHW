<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'student';

    protected $fillable = ['studentId', 'studentName', 'studentPw', 'email','phone'];

    /**
     * A student can have many homeworks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeworks()
    {
        return $this->hasMany('App\Homework');
    }

}
