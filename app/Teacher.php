<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Teacher extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'teachers';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'name','role'];

    public $incrementing = false;

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

}
