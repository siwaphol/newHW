<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'studentName', 'status'];

}