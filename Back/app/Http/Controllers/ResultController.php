<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Result;

class ResultController extends Controller
{
    // need to add previous course_id to the courses students pivot table
    public function getResult($course_id, $student_id): JsonResponse
    {
        $result = Result::where('course_id', $course_id)->where('student_id', $student_id)->first();
        $entry = Course::find($course_id)->students()->wherePivot('student_id', $student_id)->first();
        if ($result) {
            return response()->json(['data' => $result], 200);
        }
    }
}
