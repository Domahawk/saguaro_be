<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request): Collection
    {
        return User::all();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user): JsonResponse
    {
        return Response::json(
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        foreach ($data as $key => $value) {
            if (
                $key === 'password'
                && Hash::make($value) !== $user->password
            ) {
                $user->$key = Hash::make($value);

                continue;
            }

            if ($user->$key !== $value) {
                $user->$key = $value;
            }
        }

        $user->save();

        return Response::json(
            [
                'message' => "Successfully updated user",
                'user' => $user,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return Response::json([
            'message' => "Successfully deleted user",
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return Response::json(
            [
                'user' => $request->user(),
            ]
        );
    }
}
