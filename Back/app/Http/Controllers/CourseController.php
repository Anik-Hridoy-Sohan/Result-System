<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Course;
use PHPUnit\Exception;
use App\Models\Department;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function store(CourseRequest $request)
    {
        Course::create(
            [
                'course_code' => $request['course_code'],
                'semester_id' => $request['semester_id'],
                'course_teacher_id' => $request['course_teacher_id'],
                'name' => $request['name'],
                'credit' => $request['credit'],
            ]
        );

        return response()->json(['message' => 'Successfully created'], 204);
    }

    public function edit(CourseRequest $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->course_code = $request['course_code'];
            $course->course_name = $request['course_name'];
            $course->semester_id = $request['semester_id'];
            $course->course_teacher_id = $request['course_teacher_id'];
            $course->name = $request['name'];
            $course->credit = $request['credit'];
            $course->save();
        } catch (Exception $e) {
            return response()->json(['errors' => [$e->getMessage]], 400);
        }
        return response()->json(['message' => 'Successfully edited'], 200);
    }

    public function delete($id)
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master' || (Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists())) {
            $course = Course::findOfFail($id);
            $course->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['message' => 'Permission not granted'], 400);
    }

    public function getCourses($semesterId)
    {
        $courses = Course::where('semester_id', $semesterId)->get();
        return response()->json(['data' => $courses], 200);
    }
}
