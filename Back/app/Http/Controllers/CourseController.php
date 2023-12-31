<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use PHPUnit\Exception;
use App\Models\CourseType;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function store(CourseRequest $request): JsonResponse
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

    public function edit(CourseRequest $request, $id): JsonResponse
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

    public function delete($id): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master' || (Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists())) {
            $course = Course::findOfFail($id);
            $course->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['message' => 'Permission not granted'], 400);
    }

    public function getCourses($semesterId): JsonResponse
    {
        $courses = Course::where('semester_id', $semesterId)->get();
        return response()->json(['data' => $courses], 200);
    }

    public function addStudent($studentId, $courseId, $courseType): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug != 'student') {
            $course = Course::find($courseId);
            $courseTypeId = CourseType::whereRaw('LOWER(slug) = ?', [Str::lower($courseType)])->first()->id;
            // $student = User::find($studentId);
            $course->students()->attach($studentId, ['is_paid' => false, 'course_type_id' => $courseTypeId]);

            /**
            $students = $course->students;
             */
            return response()->json(['message' => 'Successfully added'], 204);
        } else {
            return response()->json(['message' => 'Unauthorized action'], 400);
        }
    }

    public function detatchStudent($studentId, $courseId): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug != 'student') {
            $course = Course::find($courseId);
            $course->students()->detach($studentId);
            return response()->json(['message' => 'Successfully detached'], 204);
        } else {
            return response()->json(['message' => 'Unauthorized action'], 400);
        }
    }

    public function editCourseStudent($studentId, $courseId, $request): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug != 'student') {
            $course = Course::find($courseId);
            $courseType = CourseType::whereRaw('LOWER(slug) = ?', [Str::lower($request['courseType'])])->first();

            $course->students()->updateExistingPivot($studentId, [
                'is_paid' => $request['is_paid'],
                'course_type_id' => $courseType->id,
            ]);
            return response()->json(['message' => 'Successfully updated']);
        } else {
            return response()->json(['message' => 'Unauthorized action'], 400);
        }
    }
}
