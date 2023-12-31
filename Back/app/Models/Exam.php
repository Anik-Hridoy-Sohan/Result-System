<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'invigilator_id', 'course_id', 'type', 'total_mark', 'achieved_mark'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function invigilator()
    {
        return $this->belongsTo(User::class, 'invigilator_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function results()
    {
        return $this->belongsToMany(Result::class, 'exams_results');
    }
}
