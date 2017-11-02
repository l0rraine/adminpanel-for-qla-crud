<?php

namespace Qla\AdminPanel;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Qla\AdminPanel\app\Exceptions\CustomHandler;

class AdminPanelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        app('router')->aliasMiddleware('admin.referer', 'Qla\AdminPanel\app\Http\Middleware\SetAdminReferer');
        app('router')->aliasMiddleware('admin.auth', 'Qla\AdminPanel\app\Http\Middleware\Authenticate');

        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/qla/adminpanel'), 'adminpanel');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'adminpanel');


        // LOAD THE CONFIG
        $this->mergeConfigFrom(
            __DIR__ . '/config/qla/adminpanel.php', 'qla.adminpanel'
        );


        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/qla/adminpanel'),
            __DIR__ . '/public' => public_path('vendor/qla'),
            __DIR__ . '/config/qla' => config_path('qla'),
        ], 'qla');

    }

    public static function setupRoutes()
    {
        $router = app('router');

        $router->group([
            'namespace' => '\Qla\AdminPanel\app\Http\Controllers',
            'middleware' => config('qla.adminpanel.admin_auth_middleware'),
            'prefix' => config('qla.adminpanel.url_prefix')],
            function () use ($router) {

                $router->get('/', 'AdminPanelController@getIndex')->name('Crud.AdminPanel.home');

            });


    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes();
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('AdminPanel', \Qla\AdminPanel\AdminPanelServiceProvider::class);


//        \App::singleton(
//
//            \Qla\AdminPanel\app\Exceptions\Handler::class
//        );


//        $this->app->register('Kodeine\Acl\AclServiceProvider');
    }
}
