<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Saritasa\Transformers\IDataTransformer;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends BaseApiController
{
    /**
     * Jwt auth service.
     *
     * @var JWTAuth
     */
    protected $jwtAuth;

    /**
     * Authenticate API Controller. Uses JWT authentication.
     *
     * @param JWTAuth $jwtAuth Jwt guard
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
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

        $credentials = $request->only('email', 'password');

        $token = $this->jwtAuth->attempt($credentials);

        return response()->json([
            "token" => $token
        ], 404);
    }
}
