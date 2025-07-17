<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return Response::json(
            [
                'user' => $request->user(),
            ]
        );
    }

    public function list(Request $request): Collection
    {
        return User::all();
    }
}
