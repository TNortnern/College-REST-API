<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
class Instructor extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'InstructorID';
    protected $table = 'instructors';

    public function courses(){
        return $this->hasMany(Course::class, 'InstructorID');
    }
}
