<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Semesteryears extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'current_semester_year';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'semester', 'year'];
    protected $primaryKey = 'id';

    public $incrementing = true;

}