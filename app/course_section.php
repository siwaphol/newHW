<?php
/**
 * Created by PhpStorm.
 * User: boonchuay
 * Date: 19/6/2558
 * Time: 8:20
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class course_section  extends model {
    protected $table='course_section';
    protected $fillable = ['courseId', 'sectionId', 'teacherId', 'created_at','updated_at'];
    public $incrementing = false;

} 