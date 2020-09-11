<?php

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\View\View;
use Saritasa\LaravelControllers\BaseController;

/**
 * Controller for home page.
 */
class SPAController extends BaseController
{
    /**
     * On Local and Dev environment, redirect to API documentation.
     * Otherwise (staging, production) redirect to frontend URL from config.
     */
    public function index(): View
    {
        // Force close debug bar (APP_DEBUG=true)
        // Must disable debug bar even development mode for SPA page.
        Debugbar::disable();

        return view('spa');
    }
}
