<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'role_id', 'student_id', 'prefix_th',
                            'prefix_en','firstname_th','firstname_en','lastname_th',
                            'lastname_en','email','faculty_id'];

    protected $primaryKey = 'username';

    public $incrementing = false;

    public function courses(){
        return $this->belongsToMany('App\Course', 'course_student', 'student_id', 'course_id')->withTimestamps();
    }

    /**
     * @param $query
     * @return mixed
     *
     * @Sample usage $users = User::admin()->orderBy('created_at')->get();
     */
    public function scopeAdmin($query)
    {
        return $query->where('role_id', 'like', '1___');
    }
    public function scopeTeacher($query)
    {
        return $query->where('role_id', 'like', '_1__');
    }
    public function scopeTa($query)
    {
        return $query->where('role_id', 'like', '__1_');
    }
    public function scopeStudent($query)
    {
        return $query->where('role_id', 'like', '___1');
    }

    /**
     * Accessor Function
     */
    public function getFirstNameEnAttribute()
    {
        return ucfirst($this->attributes['firstname_en']);
    }
    /**
     * Custom functions
     */
    public function isAdmin()
    {
        return substr($this->attributes['role_id'],0,1) == '1';
    }
    public function isTeacher()
    {
        return substr($this->attributes['role_id'],1,1) == '1';
    }
    public function isTa()
    {
        return substr($this->attributes['role_id'],2,1) == '1';
    }
    public function isStudent()
    {
        return substr($this->attributes['role_id'],3,1) == '1';
    }
}
