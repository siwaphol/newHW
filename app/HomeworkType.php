<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class HomeworkType extends Model {

    protected $table = 'homework_types';

    protected $fillable = ['id','extension'];

    //Important
    //to create or save for this model simply use HomeworkType::create(['extension'=>'here is extension']);

}
