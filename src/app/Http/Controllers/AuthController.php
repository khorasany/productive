<?php

namespace App\Http\Controllers;

use App\Repository\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var string
     */
    private string $token = 'habit-app-89klj566ln,m4nl22j';

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = UserRepo::create($fields);
        $token = $user->createToken($this->token)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function social_register(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'type' => 'required|string',
        ]);

        $user = UserRepo::social_create($fields);
        $token = $user->createToken($this->token)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ],201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = UserRepo::user($fields['email']);
        if (!$user || !Hash::check($fields['password'], $user->password))
            return response()->json([
                'message' => 'bad credentials'
            ], 401);
        UserRepo::log($user->id);
        $token = $user->createToken($this->token)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function social_login(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'type' => 'required|string'
        ]);
        $user = UserRepo::user($fields['email'],$fields['type']);
        if (!$user)
            return response()->json([
                'message' => 'user not exists'
            ], 401);
        UserRepo::social_log($user->id, $fields['type']);
        $token = $user->createToken($this->token)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
