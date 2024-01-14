<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentRequest;
use App\Models\Stage;

class DepartmentController extends Controller
{
    public function store(DepartmentRequest $request): JsonResponse
    {
        $dept = Department::create(
            [
                'name' => $request['name'],
                'slug' => $request['slug'],
                'department_code' => $request['department_code'],
                'chairman_id' => $request['chairman_id'],
            ]
        );
        $program = Program::find($request['program_id']);
        $program->departments()->attach($dept->id, ['semester_number' => $request['semester_number']]);
        return response()->json(['message' => 'Successfully created'], 204);
    }

    public function edit(DepartmentRequest $request, $id): JsonResponse
    {
        $department = Department::findOrFail($id);
        $department->name = $request['name'];
        $department->slug = $request['slug'];
        $department->department_code = $request['department_code'];
        $department->chairman_id = $request['chairman_id'];

        $department->programs()->updateExistingPivot($request['program_id'], ['semester_number' => $request['semester_number']]);

        $department->save();
        return response()->json(['message' => 'Successfully edited'], 200);
    }

    public function delete($id): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master') {
            $department = Department::findOfFail($id);
            $department->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['message' => 'Permission not granted'], 400);
    }

    public function getDepartments()
    {
        return response()->json(['data' => Department::all()], 200);
    }

    public function getProgramsWithDepartments(): JsonResponse
    {
        $programs = Program::all();
        foreach ($programs as $program) {
            $program->departments = $program->departments()->get();
        }
        return response()->json(['data' => $programs]);
    }

    public function getAllStages(): JsonResponse
    {
        return response()->json(['data' => Stage::all()]);
    }
}
