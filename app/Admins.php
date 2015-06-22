<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'adminName'];

}