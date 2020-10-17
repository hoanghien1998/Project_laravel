<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Transformers\AuthTransformer;
use App\Services\UsersService;
use Dingo\Api\Http\Response;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Tymon\JWTAuth\JWTAuth;

/**
 * User profile registration controller.
 * Handles new user registration, email confirmation and update profile requests.
 */
class UserController extends BaseApiController
{
    /**
     * JWT Auth.
     *
     * @var JWTAuth
     */
    private $jwtAuth;

    /**
     * Users business-logic service.
     *
     * @var UsersService
     */
    private $usersService;

    /**
     * Register user controller.
     *
     * @param JWTAuth $jwtAuth Jwt guard
     * @param UsersService $usersService Users business-logic service
     */
    public function __construct(
        JWTAuth $jwtAuth,
        UsersService $usersService
    ) {
        parent::__construct();
        $this->usersService = $usersService;
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * Get profile user.
     *
     * @return Response
     */
    public function userProfile(): Response
    {
        $user = $this->jwtAuth->user();
        $user_id = $user->id;
        $profile = $this->usersService->getProfile($user_id);
        return $this->json($profile, new AuthTransformer());
    }
}
