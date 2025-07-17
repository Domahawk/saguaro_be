<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        return $request->user;
    }

    public function list(Request $request): Collection
    {
        return User::all();
    }
}
