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

}
