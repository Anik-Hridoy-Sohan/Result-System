<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SemesterRequest extends FormRequest
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
        return [
            'dept_id' => 'required|exists:departments,id',
            'stage_id' => 'required|exists:stages,id',
            'year' => 'required|string',
            'program_id' => 'required|exists:programs,id',
            'unique_semester' => Rule::unique('semesters')
                ->where('dept_id', $this->input('dept_id'))
                ->where('stage_id', $this->input('stage_id'))
                ->where('year', $this->input('year'))
                ->where('program_id', $this->input('program_id')),
        ];
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
