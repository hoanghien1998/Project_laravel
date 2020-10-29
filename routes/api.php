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
use App\Http\Controllers\Api\v1\CarController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\ListingController;
use App\Http\Controllers\Api\v1\UserController;
use Dingo\Api\Routing\Router;
use Saritasa\LaravelControllers\Api\ApiResourceRegistrar;
use Saritasa\LaravelControllers\Api\ForgotPasswordApiController;
use Saritasa\LaravelControllers\Api\JWTAuthApiController;
use Saritasa\LaravelControllers\Api\ResetPasswordApiController;

/**
 * Api router instance.
 *
 * @var Router $api
 */
$api = app(Router::class);
$api->version(config('api.version'), ['middleware' => 'bindings'], function (Router $api): void {
    $registrar = new ApiResourceRegistrar($api);

    // Group of routes that require authentication
    $api->group(['middleware' => ['jwt.auth']], function (Router $api): void {

        $api->group(['prefix' => 'auth'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);
            $registrar->delete('auth', JWTAuthApiController::class, 'logout');

            $registrar->put('', JWTAuthApiController::class, 'refreshToken');
            $registrar->post('password/reset', ForgotPasswordApiController::class, 'sendResetLinkEmail');
            $registrar->put('password/reset', ResetPasswordApiController::class, 'reset');
        });

        $api->group(['prefix' => 'listings'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);

            $registrar->post('', ListingController::class, 'createListing');
            $registrar->get('', ListingController::class, 'paginatedListing');
            $registrar->get('{id}/comments', CommentController::class, 'getCommentsListing');

            $registrar->put('{id}', ListingController::class, 'updateListing');
            $registrar->post('{id}/approve', ListingController::class, 'approveListing');
        });

        $api->group(['prefix' => 'comments'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);
            $registrar->post('', CommentController::class, 'createComment');
            $registrar->get('', CommentController::class, 'paginatedComment');
        });

        $api->group(['prefix' => 'cars'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);
            $registrar->get('makes', CarController::class, 'carMakes');
            $registrar->get('models', CarController::class, 'carModels');
            $registrar->get('trims', CarController::class, 'carTrims');
        });

        $api->group(['prefix' => 'users'], function (Router $api): void {
            $registrar = new ApiResourceRegistrar($api);
            $registrar->get('me', UserController::class, 'userProfile');
        });
    });

    $registrar->post('/register', AuthController::class, 'register');
    $registrar->post('auth', JWTAuthApiController::class, 'login');
    $registrar->post('/uploads/tmp', UploadController::class,'tmpFileUploadUrl');

    $registrar->get('/listings/{id}', ListingController::class, 'getListing');
});




