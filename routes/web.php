<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Http\Controllers\SPAController;
use App\Http\Controllers\SwaggerController;

$router = app('router');

$router->namespace('App\\Http\\Controllers')->group(function() {
    Route::auth([
        'reset' => false,
        'verify' => true,
    ]);
});

$router->get('/swagger', SwaggerController::class."@index");
$router->get('/apidocs', SwaggerController::class."@apidocs");
$router->any('/{any}', SPAController::class.'@index')->where('any', '.*');
