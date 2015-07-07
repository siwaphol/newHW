<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use DB;
use Session;

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
	protected $fillable = [ 'id','username', 'role_id','firstname_th','firstname_en','lastname_th',
                            'lastname_en','email','faculty_id'];

    protected $primaryKey = 'id';

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
    public function role()
    {
        if($this->isAdmin()){
            return "Admin";
        }else if($this->isTeacher()){
            return "Teacher";
        }else if($this->isTa()){
            if($this->isStudent()){
                return "Ta, Student";
            }
            return "Ta";
        }else if($this->isStudent()){
            return "Student";
        }
        return "";
    }

    public function getCourseList(){

        if($this->isAdmin()){

            $course_list = DB::select('SELECT DISTINCT course_id FROM course_section where semester=? and year=?',array(Session::get('semester'),Session::get('year')));
            return $course_list;
        }else if($this->isTeacher()){
            $course_list = DB::select('SELECT DISTINCT course_id FROM course_section WHERE teacher_id = ? and semester=? and year=?',array($this->attributes['id'],Session::get('semester'),Session::get('year')));
            return $course_list;
        }
    }
}
