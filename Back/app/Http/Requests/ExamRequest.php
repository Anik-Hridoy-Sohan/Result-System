<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Course::findOrFail($this->input('course_id'))->course_teacher_id == Auth::user()->id) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'student_id' => 'required|numeric',
            'invigilator_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'type' => 'required|string|max: 255',
            'total_mark' => 'required|decimal:2',
            'achived_mark' => 'required|decimal:2'
        ];

        $rules['unique_student_course'] = Rule::unique('exams')
            ->where(function ($query) {
                return $query->where('student_id', $this->input('student_id'))
                    ->where('course_id', $this->input('course_id'));
            });

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => "validation error",
            'errors' => $validator->errors()
        ], 400));
    }
}
