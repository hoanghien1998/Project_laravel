<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Saritasa\LaravelControllers\BaseController;

/**
 * Controller for home page.
 */
class HomeController extends BaseController
{
    /**
     * On Local and Dev environment, redirect to API documentation.
     * Otherwise (staging, production) redirect to frontend URL from config.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->to(App::environment('local', 'development') ? 'apidocs' : config('app.url'));
    }
}
