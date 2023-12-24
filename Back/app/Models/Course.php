<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['course_code', 'semester_id', 'course_teacher_id', 'name', 'credit'];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function courseTeacher()
    {
        return $this->belongsTo(User::class, 'course_teacher_id');
    }
}
