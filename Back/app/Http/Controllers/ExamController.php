<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use PHPUnit\Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ExamRequest;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function store(ExamRequest $request): JsonResponse
    {
        Exam::create(
            [
                'student_id' => $request['student_id'],
                'invigilator_id' => $request['invigilator_id'],
                'course_id' => $request['course_id'],
                'type' => $request['type'],
                'total_mark' => $request['total_mark'],
                'achived_mark' => $request['achived_mark'],
            ]
        );
        return response()->json(['message' => 'Successfully created'], 204);
    }

    public function edit(ExamRequest $request, $id): JsonResponse
    {
        try {
            $exam = Exam::findOrFail($id);
            $exam->student_id = $request['student_id'];
            $exam->invigilator_id = $request['invigilator_id'];
            $exam->course_id = $request['course_id'];
            $exam->type = $request['type'];
            $exam->total_mark = $request['total_mark'];
            $exam->achived_mark = $request['achived_mark'];
            $exam->save();
        } catch (Exception $e) {
            return response()->json(['errors' => [$e->getMessage]], 400);
        }
        return response()->json(['message' => 'Successfully edited'], 200);
    }

    public function delete($id): JsonResponse
    {
        if (Course::findOrFail($this->input('course_id'))->course_teacher_id == Auth::user()->id) {
            $exam = Exam::findOfFail($id);
            $exam->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['message' => 'Permission not granted'], 400);
    }

    public function getExams($course_id, $student_id): JsonResponse
    {
        $exams = Exam::where('course_id', $course_id)->where('student_id', $student_id)->get();
        return response()->json(['data' => $exams], 200);
    }
}
