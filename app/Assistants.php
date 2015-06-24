<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistants extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assistants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['courseId', 'sectionId', 'taId'];

}