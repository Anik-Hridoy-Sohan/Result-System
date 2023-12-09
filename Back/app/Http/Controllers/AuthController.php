<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'mobile' => '1234567890'
        ]);
        $mailData = [
            "name" => $request["name"],
            "link" => "http://localhost:5173/verify-user/" . $user->id,
        ];

        // send mail
        dispatch(new SendUserVarifyMail(["send-to" => $user->email, "data" => $mailData]));
        return response()->json(['message' => "Successfully registered, please check your email"], 204);
    }
}
