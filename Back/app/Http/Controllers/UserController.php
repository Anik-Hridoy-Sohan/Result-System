<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Stage;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function searchStudent($key): JsonResponse
    {
        $usersById = User::where('student_id', 'like', '%' . $key . '%')->get();
        $userByName = User::where('name', 'like', '%' . $key . '%')->get();
        $users = $usersById->concat($userByName)->sortBy('timestamp')->values();
        $responsUsers = array();
        foreach ($users as $user) {
            if ($user->email_verified_at && $user->status != -1) {
                $tempUser =  array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                    'department' => Department::findOrFail($user->dept_id)->name,
                    'program' => Program::findOrFail($user->program_id)->name,
                    'stage' => Stage::findOrFail($user->stage_id)->name,
                );
                array_push($responsUsers, $tempUser);
            }
        }
        return response()->json(['data' => $responsUsers], 200);
    }

    public function searchTeacher($key): JsonResponse
    {
        $usersById = User::where('teacher_id', 'like', '%' . $key . '%')->get();
        $userByName = User::where('name', 'like', '%' . $key . '%')->get();
        $users = $usersById->concat($userByName)->sortBy('timestamp')->values();
        $responsUsers = array();
        foreach ($users as $user) {
            if ($user->email_verified_at && $user->status != -1) {
                $tempUser =  array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                    'department' => Department::findOrFail($user->dept_id)->name,
                );
                array_push($responsUsers, $tempUser);
            }
        }
        return response()->json(['data' => $responsUsers], 200);
    }


    public function edit(SignUpRequest $request, $id)
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master') {
            $user = User::findOrFail($id);
            $user->name = $request['name'];
            // $user->email = $request['email'];
            $user->address = $request['address'];
            if ($request['doc_file']) {
                $user->doc_file = $request['doc_file'];
            }
            if ($request['avatar']) {
                $user->avatar = $request['avatar'];
            }
            $user->mobile = $request['mobile'];
            $user->father_name = $request['father_name'];
            $user->mother_name = $request['mother_name'];
            $user->nationality = $request['nationality'];
            $user->religion = $request['religion'];
            $user->dob = $request['dob'];
            $user->emergency_mobile = $request['emergency_mobile'];
            $user->student_id = $request['student_id'];
            $user->program_id = $request['program_id'];
            $user->stage_id = $request['stage_id'];
            $user->session = $request['session'];
            $user->teacher_id = $request['teacher_id'];
            $user->staff_id = $request['staff_id'];
            $user->dept_id = $request['dept_id'];
            $user->previous_id = $request['previous_id'];
            $user->save();
            return response()->json(['message' => 'successfully edited'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized action'], 400);
        }
    }

    public function approveUser($id): JsonResponse
    {
        $user = User::findOrFail($id);
        if (Role::findOrFail($user->role_id)->slug == 'master') {
            return response()->json(['message' => 'Cound not approve the user'], 401);
        } else if (Role::findOrFail($user->role_id)->slug == 'teacher' || Role::findOrFail($user->role_id)->slug == 'staff') {
            if (Role::findOrFail(Auth::user()->role_id)->slug == 'master') {
                $user->status = 0;
                $user->save();
                return response()->json(['message' => 'Successfully approved the user'], 200);
            } else {
                return response()->json(['message' => 'Cound not approve the user'], 401);
            }
        } else if (Role::findOrFail($user->role_id)->slug == 'student') {
            if ((Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists()) || Role::findOrFail(Auth::user()->role_id)->slug == 'master') {
                $user->status = 0;
                $user->save();
                return response()->json(['message' => 'Successfully approved the user'], 200);
            } else {
                return response()->json(['message' => 'Cound not approve the user'], 401);
            }
        }
    }

    public function getAllPendingUsers(): JsonResponse
    {
        $users = User::where('email_verified_at', "<>", null)->where('status', -1)->get();
        $responsUsers = array();
        foreach ($users as $user) {
            $department = null;
            if (Role::findOrFail($user->role_id)->slug != 'staff' && Role::findOrFail($user->role_id)->slug != 'master') {
                $department = Department::findOrFail($user->dept_id)->name;
            }
            $tempUser =  array(
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'department' => $department,
            );
            array_push($responsUsers, $tempUser);
        }
        return response()->json(['data' => $responsUsers], 200);
    }

    public function delete($id): JsonResponse
    {
        $user = User::findOrFail($id);
        if ((Role::findOrFail($user->role_id)->slug == 'student' && (Role::findOrFail(Auth::user()->role_id) == 'teacher' && Department::where('chairman_id', Auth::user()->id)->exists()) && Auth::user()->dept_id == $user->dept_id) || Role::findOrFail(Auth::user()->role_id) == 'master') {
            $user->delete();
            return response()->json(['message' => 'Successfully deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized action'], 400);
        }
    }
}
