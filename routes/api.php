<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\ListingController;
use Dingo\Api\Routing\Router;
use Saritasa\LaravelControllers\Api\ApiResourceRegistrar;
use Saritasa\LaravelControllers\Api\JWTAuthApiController;
use Saritasa\LaravelControllers\Api\ForgotPasswordApiController;
use Saritasa\LaravelControllers\Api\ResetPasswordApiController;

/**
 * Api router instance.
 *
 * @var Router $api
 */
$api = app(Router::class);
$api->version(config('api.version'), ['middleware' => 'bindings'], function (Router $api) {
    $registrar = new ApiResourceRegistrar($api);

    // Group of routes that require authentication
    $api->group(['middleware' => ['jwt.auth']], function (Router $api) {

        $api->group(['prefix' => 'auth'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);

            $registrar->put('', JWTAuthApiController::class, 'refreshToken');
            $registrar->post('password/reset', ForgotPasswordApiController::class, 'sendResetLinkEmail');
            $registrar->put('password/reset', ResetPasswordApiController::class, 'reset');
        });

        $api->group(['prefix' => 'listings'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);

            $registrar->post('', ListingController::class,'createListing');
            $registrar->get('', ListingController::class,'paginatedListing');
            $registrar->get('{id}', ListingController::class,'getListing');
            $registrar->put('{id}', ListingController::class,'updateListing');

        });

        $api->group(['prefix' => 'comments'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);

            $registrar->get('/', CommentController::class,'paginatedComment');

        });
    });

    $registrar->post('/register', AuthController::class,'register');
    $registrar->post('auth', JWTAuthApiController::class, 'login');
    $registrar->post('/comments', CommentController::class,'createComment');

});




