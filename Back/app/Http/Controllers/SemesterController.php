<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SemesterRequest;

class SemesterController extends Controller
{
    public function store(SemesterRequest $request): JsonResponse
    {
        Semester::create($request->all());
        return response()->json(['message' => 'Semester created successfully'], 201);
    }

    public function edit(SemesterRequest $request, $id): JsonResponse
    {
        $semester = Semester::findOrFail($id);
        $semester->update($request->all());

        return response()->json(['message' => 'Semester updated successfully'], 200);
    }

    public function delete($id): JsonResponse
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master' || (Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists())) {
            return true;
        }
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return response()->json(['message' => 'Semester deleted successfully'], 200);
    }

    public function getSemesters($dept_id, $program_id): JsonResponse
    {
        $semesters = Semester::where('dept_id', $dept_id)
            ->where('program_id', $program_id)
            ->get();

        return response()->json(['data' => $semesters], 200);
    }
}
