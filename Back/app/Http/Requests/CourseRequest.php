<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master' || (Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists())) {
            return true;
        }
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
            'course_code' => 'required|string|max:63',
            'semester_id' => 'required|digits',
            'course_teacher_id' => 'required|digits',
            'name' => 'required|string|max:255',
            'cradit' => 'required|decimal:2'
        ];

        // unique rule for semester_id and course_code combination
        $rules['semester_id_course_code_unique'] = Rule::unique('courses')->where(function ($query) {
            return $query->where('semester_id', $this->input('semester_id'))
                ->where('course_code', $this->input('course_code'));
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
