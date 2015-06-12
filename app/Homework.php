<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model {

    protected $table = 'homework_sending';

    protected $fillable = ['studentId', 'courseId', 'homeworkFileName', 'sendStatus','submitted_at'];

    /**
     * A homework is owned by a student
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(){
        return $this->belongsTo('App\Student');
    }

}
