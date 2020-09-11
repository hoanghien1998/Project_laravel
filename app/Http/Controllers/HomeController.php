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
     */
    public function index()
    {
        return view('home/index');
    }
}
