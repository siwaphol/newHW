<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ta extends Model {

    protected $table = 'tas';

    protected $fillable = ['id', 'taName', 'taPw', 'phone','email'];

    public $incrementing = false;

}
