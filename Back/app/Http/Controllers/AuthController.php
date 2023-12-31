<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\SendUserVarifyMail;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at !== null)    return response()->json(['message' => 'Login successful', 'user' => Auth::user()], 200);
            else return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function signup(SignUpRequest $request): JsonResponse
    {
        $role = 0;
        if ($request->input('role') == 'master') {
            $role = 1;
        } else if ($request->input('role') == 'teacher') {
            $role = 2;
        } else if ($request->input('role') == 'staff') {
            $role = 3;
        } else if ($request->input('role') == 'student') {
            $role = 4;
        } else {
            return response()->json(['message' => 'Invalid role'], 400);
        }

        $token = Str::random(16);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'created_at' => now(),
            'role_id' => $role,
            'address' => $request['address'],
            'mobile' => $request['mobile'],
            'father_name' => $request['father_name'],
            'mother_name' => $request['mother_name'],
            'avatar' => $request['avatar'],
            'doc_file' => $request['doc_file'],
            'nationality' => $request['nationality'],
            'dob' => $request['dob'],
            'emergency_mobile' => $request['emergency_mobile'],
            'dept_id' => $request['dept_id'],
            'status' => -1,
            'religion' => $request['religion'],
            'teacher_id' => $request['teacher_id'],
            'staff_id' => $request['staff_id'],
            'student_id' => $request['student_id'],
            'previous_id' => $request['previous_id'],
            'program_id' => $request['program_id'],
            'stage_id' => $request['stage_id'],
            'session' => $request['session'],
            'remember_token' => $token,
        ]);

        $mailData = [
            "name" => $request["name"],
            "link" => env('APP_URL') . "/verify-user/" . $user->id . '/' . $token,
        ];

        // send mail
        dispatch(new SendUserVarifyMail(["send-to" => $user->email, "data" => $mailData]));
        return response()->json(['message' => "Successfully registered, please check your email"], 204);
    }

    public function verifyEmail($id, $token): JsonResponse
    {
        $user = User::findOrFail($id);
        if ($user->remember_token == $token) {
            $user->email_verified_at = now();
            $user->remember_token = '';
            return response()->json(['message' => 'e-mail verified'], 200);
        } else {
            return response()->json(['message' => 'invalid_token'], 404);
        }
    }

    public function resendEmail($id): JsonResponse
    {
        $user = User::findOrFail($id);
        if (!$user->email_verified_at) {
            $token = Str::random(16);
            $user->remember_token = $token;
            $user->save();
            $mailData = [
                "name" => $user->name,
                "link" => env('APP_URL') . "/verify-user/" . $user->id . '/' . $token,
            ];
            dispatch(new SendUserVarifyMail(["send-to" => $user->email, "data" => $mailData]));
            return response()->json(['message' => 'please, check your email'], 200);
        }
    }
}
