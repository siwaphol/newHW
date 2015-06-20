<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    protected $table = 'teachers';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'name'];

    public $incrementing = false;

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

}
