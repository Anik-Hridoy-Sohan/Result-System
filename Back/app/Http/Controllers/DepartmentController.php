<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function store(DepartmentRequest $request)
    {
        Department::create(
            [
                'name' => $request['name'],
                'slug' => $request['slug'],
                'department_code' => $request['department_code'],
                'chairman_id' => $request['chairman_id'],
            ]
        );
        return response()->json(['message' => 'Successfully created'], 204);
    }

    public function edit(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->name = $request['name'];
        $department->slug = $request['slug'];
        $department->department_code = $request['department_code'];
        $department->chairman_id = $request['chairman_id'];
        $department->save();
        return response()->json(['message' => 'Successfully edited'], 200);
    }

    public function delete($id)
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
        return response()->json(['departments' => Department::all()], 200);
    }
}
