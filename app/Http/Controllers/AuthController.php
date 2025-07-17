<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): array
    {
        return ['message' => 'loggedin'];
    }

    public function logout(Request $request): array
    {
        return ['message' => 'loggedout'];
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
