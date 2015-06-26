<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ta extends Model {

    protected $table = 'student';

    protected $primaryKey = 'username';

    protected $fillable = ['username', 'id', 'name', 'email','phone'];

    public $incrementing = false;

}
