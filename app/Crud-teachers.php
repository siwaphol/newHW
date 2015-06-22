<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Crud-teachers extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'teacherName'];

}