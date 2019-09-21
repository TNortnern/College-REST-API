<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Instructor;

class Course extends Model
{
    protected $guarded = [];
    protected $table = 'courses';
    protected $primarykey = 'CourseID';
    public function instructor(){
       return $this->belongsToMany(Instructor::class, 'InstructorID');
    }
}
