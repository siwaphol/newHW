<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tas extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tas';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'taName'];

}