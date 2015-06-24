<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework_assignments extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'homework_assignment';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','courseId','issec','sectionid','homeworkname', 'homeworkFileName', 'homeworkFileType', 'homeworkDetail', 'issubFolder', 'subFolder', 'dueDate', 'assignDate', 'acceptDate'];

}