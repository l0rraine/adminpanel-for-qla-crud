<?php

namespace Qla\Manager;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/qla/manager'), 'manager');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'manager');


        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/qla/manager'),
            __DIR__.'/public' => public_path('vendor/qla'),
        ], 'qla');

    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Qla\Manager\app\Http\Controllers'], function ($router) {
            \Route::group(['prefix' => config('qla.base.route_prefix', 'manager'), 'middleware' => config('qla.base.admin_auth_middleware',['web'])], function () {
                \Route::get('/', 'ManagerController@getIndex')->name('Crud.Manager.home');
            });
        });
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes($this->app->router);

//        $this->app->register('Kodeine\Acl\AclServiceProvider');
    }
}
