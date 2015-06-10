<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ta extends Model {

    protected $table = 'ta';

    protected $fillable = ['taId', 'taName', 'taPw', 'phone','email'];

}
