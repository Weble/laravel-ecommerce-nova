<?php

namespace Weble\LaravelEcommerceNova;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Weble\LaravelEcommerceNova\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-ecommerce-nova');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (\Laravel\Nova\Events\ServingNovaervingNova $event) {
            Nova::script('nova-money-field', __DIR__ . '/../../dist/js/field.js');
            Nova::style('nova-money-field', __DIR__ . '/../../dist/css/field.css');
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/weble/laravel-ecommerce-nova')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
