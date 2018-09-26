<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        parent::boot();
    }
    
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        
        $this->mapWebRoutes();
        
        $this->mapAdminRoutes();
        
        //
    }
    
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            #'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
            require base_path('routes/admin/AuthenticationRoutes.php');
        });
    }
    
    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => [
                'api',
                'localeSessionRedirect',
                'localizationRedirect',
                'localeViewPath'
            ],
            #'namespace'  => $this->namespace,
            'prefix'     => LaravelLocalization::setLocale() . '/api',
        ], function ($router) {
    
            require base_path('routes/api.php');
            
            // Loop to all api routes available
            foreach(scandir(base_path('routes/api/v1/')) as $file) {
                if(is_file($filePath = base_path("routes/api/v1/{$file}"))) {
                    require $filePath;
                }
            }
        });
    }
    
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => [
                'web',
                'localeSessionRedirect',
                'localizationRedirect',
                'localeViewPath'
            ],
            'prefix'     => LaravelLocalization::setLocale() . '/admin',
        ], function ($router) {
    
            // Loop to all api routes available
            foreach(scandir(base_path('routes/admin/')) as $file) {
                if(is_file($filePath = base_path("routes/admin/{$file}"))) {
                    require $filePath;
                }
            }
        });
    }
}
