<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:511',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'doc_file' => 'nullable|extensions:zip,7z,rar',
            'mobile' => 'required|string|max:15',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'dob' => 'required|date',
            'emergency_mobile' => 'required|string|max:15',
        ];

        if ($this->input('role') == 'master') {
            $rules['student_id'] = 'missing';
            $rules['program_id'] = 'missing';
            $rules['stage_id'] = 'missing';
            $rules['session'] = 'missing';
            $rules['teacher_id'] = 'prohibits:staff_id|numeric|unique:users';
            $rules['staff_id'] = 'prohibits:teacher_id|numeric|unique:users';
            $rules['dept_id'] = 'nullable|exists:departments,id';
            $rules['previous_id'] = 'nullable|exists:users,id';
        } else if ($this->input('role') == 'teacher') {
            $rules['student_id'] = 'missing';
            $rules['program_id'] = 'missing';
            $rules['stage_id'] = 'missing';
            $rules['session'] = 'missing';
            $rules['teacher_id'] = 'required|numeric|unique:users';
            $rules['staff_id'] = 'missing';
            $rules['dept_id'] = 'required|numeric';
            $rules['previous_id'] = 'nullable|exists:users,id';
        } else if ($this->input('role') == 'staff') {
            $rules['student_id'] = 'missing';
            $rules['program_id'] = 'missing';
            $rules['stage_id'] = 'missing';
            $rules['session'] = 'missing';
            $rules['teacher_id'] = 'missing';
            $rules['staff_id'] = 'required|numeric|unique:users';
            $rules['dept_id'] = 'nullable|exists:departments,id';
            $rules['previous_id'] = 'nullable|exists:users,id';
        } else if ($this->input('role') == 'student') {
            $rules['student_id'] = 'required|numeric';
            $rules['program_id'] = 'required|numeric';
            $rules['stage_id'] = 'required|exists:stages,id';
            $rules['session'] = 'required|string|max:7';
            $rules['teacher_id'] = 'missing';
            $rules['staff_id'] = 'missing';
            $rules['dept_id'] = 'required|exists:departments,id';
            $rules['previous_id'] = 'nullable|exists:users,id';

            $rules['student_id_program_id_unique'] = Rule::unique('users')->where(function ($query) {
                return $query->where('program_id', $this->input('program_id'))
                    ->where('student_id', $this->input('student_id'));
            });
        }

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
