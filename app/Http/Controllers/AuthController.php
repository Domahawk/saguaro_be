<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return Response::json(
                [
                    'message' => 'Authentication failed',
                    'errors' => [
                        ['Incorrect email or password']
                    ]
                ],
                422,
            );
        }
        // create token

        $token = $user->createToken('token')->plainTextToken;


        return Response::json(
            [
                'message' => 'Login success!',
                'token' => $token,
            ]
        );
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();

        return ['message' => 'Logout success!'];
    }

    public function register(RegisterUserRequest $request): array
    {
        $data = $request->validated();

        $user = User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        return ['message' => 'Success'];
    }
}
