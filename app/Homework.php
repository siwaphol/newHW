<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model {

    protected $table = 'homework';

    protected $fillable = ['course_id', 'section', 'name', 'type_id'
        ,'detail','sub_folder', 'assign_date', 'due_date'
        ,'accept_date','created_by','semester','year'];

//    /**
//     * A homework is owned by a student
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function student(){
//        return $this->belongsTo('App\User');
//    }
//    /**
//     * homework templates are owned by a teacher
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function teacher(){
//        return $this->belongsTo('App\User');
//    }

}
