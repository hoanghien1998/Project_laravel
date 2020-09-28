<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    /**
     * Register a User.
     *
     * @param RegisterRequest $request Form register validate
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users'
        ]);
        if ($v->fails()) {
            return response()->json([
                "message" => "The email already taken"
            ], 404);
        }

        $user = User::create(array_merge(
            $request->validated(),
            ['email' => $request->email]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 200);
    }
}
