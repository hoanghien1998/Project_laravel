<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Http\Transformers\BaseTransformer;

/**
 * Provider with specific for this application settings.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        URL::forceRootUrl(config('app.url'));
        $this->app->singleton('app.api.exception', ApiExceptionHandler::class);
        // Fix for MySQL 5.6. See https://github.com/laravel/framework/issues/17508
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("League\\Fractal\\TransformerAbstract", BaseTransformer::class);
    }
}
