<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model {

    protected $table = 'homework_assignment';

    protected $fillable = ['course_id', 'name', 'type', 'detail','sub_folder','due_date', 'assign_date'];

    public $incrementing = false;

    protected $primaryKey = 'course_id';

    /**
     * A homework is owned by a student
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(){
        return $this->belongsTo('App\Student');
    }

}
